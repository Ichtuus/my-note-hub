<?php

namespace App\Controller\Application\Api\Note;

use App\Entity\Hub\Hub;
use App\Entity\Note\Note;
use App\Entity\User\User;
use App\Finder\Notes\NotesFinder;
use App\Procedure\Note\NoteCreationProcedure;
use App\Serializer\Note\NoteArraySerializer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @method User getUser()
 */
class NoteController extends AbstractController
{
    private NoteCreationProcedure $noteCreationProcedure;
    private NoteArraySerializer $noteArraySerializer;
    private NotesFinder $NotesFinder;

    public function __construct(
        NoteCreationProcedure $noteCreationProcedure,
        NoteArraySerializer $noteArraySerializer,
        NotesFinder $NotesFinder
    ) {
        $this->noteCreationProcedure = $noteCreationProcedure;
        $this->noteArraySerializer = $noteArraySerializer;
        $this->NotesFinder = $NotesFinder;
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

}
