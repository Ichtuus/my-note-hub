<?php

namespace App\Builder\Note;

use App\Entity\Hub\Hub;
use App\Entity\Note\Note;
use App\Entity\User\User;
use DateTime;

class NoteDirector
{
    public function buildNote(Hub $hub, User $user, $data)
    {
        $note = new Note();

        if(!empty($data->getNoteTitle())) {
            $note->setNoteTitle($data->getNoteTitle());
        }
        if(!empty($data->getNoteContent())) {
            $note->setNoteContent($data->getNoteContent());
        }
        if(!empty($data->getNoteFirstLink())) {
            $note->setNoteFirstLink($data->getNoteFirstLink());
        }
        if(!empty($data->getNoteSecondLink())) {
            $note->setNoteSecondLink($data->getNoteSecondLink());
        }
        if(!empty($data->getNoteThirdLink())) {
            $note->setNoteThirdLink($data->getNoteThirdLink());
        }
        $note->setCreationDatetime(new DateTime());
//      $anime->setstartDate(new DateTime($data['startDate']));
        $note->setCreator($user);
        $note->setHub($hub);
        return $note;
    }
}
