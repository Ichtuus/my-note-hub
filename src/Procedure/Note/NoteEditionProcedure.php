<?php

namespace App\Procedure\Note;

use App\Entity\Hub\Hub;
use App\Service\Patcher\Patch;
use App\Service\Patcher\PatchObject;

class NoteEditionProcedure
{
    private Patch $patcher;

    public function __construct(Patch $patcher)
    {
        $this->patcher = $patcher;
    }

    public function patchNoteProcess(Hub $hub, PatchObject $patch)
    {
        // TODO set valid value by hub
        // TODO set valid op for this ressource
        // TODO set path to good ressource
    }

}
