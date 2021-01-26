<?php

namespace App\Procedure\Note;

use App\Entity\Note\Note;
use App\Repository\Note\NoteRepository;
use App\Service\Patcher\Patch;
use App\Service\Patcher\PatchObject;

class NoteEditionProcedure
{
    private Patch $patcher;
    private NoteRepository $noteRepository;

    public function __construct(
        Patch $patcher,
        NoteRepository $noteRepository
    ) {
        $this->patcher = $patcher;
        $this->noteRepository = $noteRepository;
    }

    public function patchNoteProcess(Note $note, PatchObject $patch)
    {
        $this->patcher->setValues([
            'notes' => $this->noteRepository->findByHub($note->getHub())
        ])
        ->setOperations([
            PatchObject::OPERATION_REPLACE
        ])
        ->setPathList([
            [
                'path' => '/noteTitle',
                'regex' => false
            ],
            [
                'path' => '/noteContent',
                'regex' => false
            ],
            [
                'path' => '/noteTitle',
                'regex' => false
            ],
            [
                'path' => '/note_first_link',
                'regex' => false
            ],
            [
                'path' => '/note_second_link',
                'regex' => false
            ],
            [
                'path' => '/note_third_link',
                'regex' => false
            ],
        ])
        ->patch($note, $patch);
    }

}
