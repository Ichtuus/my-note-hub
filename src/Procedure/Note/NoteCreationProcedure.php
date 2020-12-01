<?php

namespace App\Procedure\Note;

use App\Builder\Note\NoteDirector;
use App\Entity\Hub\Hub;
use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NoteCreationProcedure
{

    private NoteDirector $noteDirector;
    private ValidatorInterface $validator;
    private EntityManagerInterface $entityManager;


    public function __construct(
        NoteDirector $noteDirector,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ) {
        $this->noteDirector = $noteDirector;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Hub $hub
     * @param User $creator
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function createNote($data)
    {
        $note = $this->noteDirector->buildNote($data);

        $violations = $this->validator->validate($note);
        if ($violations->count()) {
            throw New Exception($violations);
        }

        $this->entityManager->persist($note);
        $this->entityManager->flush();

        return $note;
    }

}
