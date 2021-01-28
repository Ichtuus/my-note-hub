<?php

namespace App\Controller\Application\Api\Note;

use App\Entity\Hub\Hub;
use App\Entity\Note\Note;
use App\Entity\User\User;
use App\Factory\Note\PatchFactory;
use App\Finder\Notes\NotesFinder;
use App\Form\Note\Type\NoteType;
use App\Procedure\Note\NoteCreationProcedure;
use App\Procedure\Note\NoteEditionProcedure;
use App\Repository\Note\NoteRepository;
use App\Serializer\Note\NoteArraySerializer;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @method User getUser()
 */
class NoteController extends AbstractController
{
    private $translator;
    private NoteCreationProcedure $noteCreationProcedure;
    private NoteEditionProcedure $noteEditionProcedure;
    private NoteRepository $noteRepository;
    private PatchFactory $patchFactory;
    private NoteArraySerializer $noteArraySerializer;
    private NotesFinder $NotesFinder;
    private EntityManagerInterface $entityManager;


    public function __construct(
        TranslatorInterface $translator,
        NoteCreationProcedure $noteCreationProcedure,
        NoteEditionProcedure $noteEditionProcedure,
        NoteRepository $noteRepository,
        PatchFactory $patchFactory,
        NoteArraySerializer $noteArraySerializer,
        NotesFinder $NotesFinder,
        EntityManagerInterface $entityManager
    ) {
        $this->translator = $translator;
        $this->noteCreationProcedure = $noteCreationProcedure;
        $this->noteEditionProcedure = $noteEditionProcedure;
        $this->noteRepository = $noteRepository;
        $this->patchFactory = $patchFactory;
        $this->noteArraySerializer = $noteArraySerializer;
        $this->NotesFinder = $NotesFinder;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route(
     *     "/hub/{id}/notes",
     *     name="my_note_hub_api_note_get",
     *     methods={"GET"},
     *     options={"expose"=true}
     * )
     * @param Hub $hub
     * @return JsonResponse
     */
    public function getNotes(Hub $hub)
    {
        $hubNotes = $this->NotesFinder->find($hub);
        return $this->json($this->noteArraySerializer->listToArray($hubNotes));
    }

    /**
     * @Route(
     *     "/hub/{id}/notes/add",
     *     name="my_note_hub_api_note_add",
     *     methods={"POST"},
     *     options={"expose"=true}
     * )
     * @param Request $request
     * @param Hub $hub
     * @param SerializerInterface $serializer
     * @param PublisherInterface $publisher
     * @return JsonResponse
     * @throws Exception
     */
    public function add(Request $request, Hub $hub, SerializerInterface $serializer, PublisherInterface $publisher)
    {
        $data = $serializer->deserialize($request->getContent(),Note::class, 'json');
        // TODO Improve handler of topics
        return $this->json([
            'note' => $this->noteArraySerializer->toArray($this->noteCreationProcedure->createNote($hub, $this->getUser(), $data))
        ]);
    }

    /**
     * @Route(
     *     "/notes/{id}/notes/patch",
     *     name="my_note_hub_api_note_patch",
     *     methods={"PATCH"},
     *     options={"expose"=true}
     * )
     * @param Note $note
     * @param Request $request
     * @param FormInterface $form
     * @throws \Symfony\Component\HttpClient\Exception\JsonException
     */
    public function patch(Note $note, Request $request)
    {
        $note = $this->noteRepository->findOneBy(["id" => $note->getId()]);
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(NoteType::class, $note);
        $form->submit($data, false);
        if(false === $form->isValid()) {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'errors' => $this->convertFormToArray($form)
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
        $this->entityManager->flush();
        return $this->json([
            "data" => $this->noteArraySerializer->toArray(
                $note
            )
        ]);
    }
    public function convertFormToArray(FormInterface $data)
    {
        $form = $errors = [];

        foreach ($data->getErrors() as $error) {
            $errors[] = $this->getErrorMessage($error);
        }

        if ($errors) {
            $form['errors'] = $errors;
        }

        $children = [];
        foreach ($data->all() as $child) {
            if ($child instanceof FormInterface) {
                $children[$child->getName()] = $this->convertFormToArray($child);
            }
        }

        if ($children) {
            $form['children'] = $children;
        }

        return $form;
    }
    private function getErrorMessage(FormError $error)
    {

        return $this->translator->trans($error->getMessageTemplate(), $error->getMessageParameters(), 'validators');
    }
}
