<?php

namespace App\Procedure\Note;

use App\Entity\Note\Note;
use App\Repository\Note\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpClient\Exception\JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Translation\TranslatorInterface;

class NoteEditionProcedure
{
    private EntityManagerInterface $entityManager;
    private NoteRepository $noteRepository;
    private ContainerInterface $container;
    private TranslatorInterface $translator;


    public function __construct(
        EntityManagerInterface $entityManager,
        NoteRepository $noteRepository,
        ContainerInterface $container,
        TranslatorInterface $translator
    ) {
        $this->entityManager = $entityManager;
        $this->noteRepository = $noteRepository;
        $this->container = $container;
        $this->translator = $translator;
    }

    public function patchNoteProcess($data, $type, Note $note)
    {
        $note = $this->noteRepository->findOneBy(["id" => $note->getId()]);
        $form = $this->container->get('form.factory')->create($type, $note, $options = []);

        if(empty($data)) {
            Throw new JsonException('Value must be provide');
        }

        $form->submit($data, false);

        if(!$form->isValid()) {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'errors' => $this->convertFormToArray($form)
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $this->entityManager->flush();

        return $note;
    }

    private function convertFormToArray(FormInterface $data)
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
