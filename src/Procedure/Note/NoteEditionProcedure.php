<?php

namespace App\Procedure\Note;

use App\Entity\Note\Note;
use App\Form\Note\Type\NoteType;
use App\Repository\Note\NoteRepository;
use App\Service\Patcher\Patch;
use App\Service\Patcher\PatchObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class NoteEditionProcedure
{
    private Patch $patcher;
    private EntityManagerInterface $entityManager;

    public function __construct(
        Patch $patcher,
        EntityManagerInterface $entityManager
    ) {
        $this->patcher = $patcher;
        $this->entityManager = $entityManager;
    }

    public function patchNoteProcess(PatchObject $patch, $form)
    {
        $form->submit($patch->value, false);
        if(false === $form->isValid()) {
            return new JsonResponse(
                [
                    'status' => 'error',
                    'errors' => $form
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
//        dump($form);die();
        $this->entityManager->flush();
    }

}
