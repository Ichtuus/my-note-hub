<?php

namespace App\Procedure\Note;

use App\Entity\Note\Note;
use Doctrine\ORM\EntityManagerInterface;

class NoteDeletionProcedure
{
    private EntityManagerInterface $entityManager;


    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function deleteNoteProcess(Note $note)
    {
        $this->entityManager->remove($note);
        $this->entityManager->flush();
    }
}
