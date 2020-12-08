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
//        dump(empty($data->getNoteTitle())); die();
        $note = new Note();

        if(empty($data->getNoteTitle())) {
            $data->setNoteTitle($data->getNoteTitle());
        }
        if(empty($data->getNoteContent())) {
            $data->setNoteContent($data->getNoteContent());
        }
        if(empty($data->getNoteFirstLink())) {
            $data->setNoteFirstLink($data->getNoteFirstLink());
        }
        if(empty($data->getNoteSecondLink())) {
            $data->setNoteSecondLink($data->getNoteSecondLink());
        }
        if(empty($data->getNoteThirdLink())) {
            $data->setNoteThirdLink($data->getNoteThirdLink());
        }
//        $data->setCreationDatetime(new DateTime());
//      $anime->setstartDate(new DateTime($data['startDate']));
        $note->setCreator($user);
        $note->setHub($hub);
        return $note;
    }
}
