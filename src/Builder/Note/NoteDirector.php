<?php

namespace App\Builder\Note;

use App\Entity\Hub\Hub;
use App\Entity\Note\Note;
use App\Entity\User\User;
use DateTime;

class NoteDirector
{
    public function buildNote($data)
    {
        dump($data); die();
        $note = new Note();

//        if(isset($data['title'])) {
//            $anime->setTitle($data['title']);
//        }
//        if(isset($data['imageUrl'])) {
//            $anime->setImageUrl($data['imageUrl']);
//        }
//        if(isset($data['synopsis'])) {
//            $anime->setSynopsis($data['synopsis']);
//        }
//        if(isset($data['type'])) {
//            $anime->setType($data['type']);
//        }
//        if(isset($data['episodes'])) {
//            $anime->setEpisodes($data['episodes']);
//        }
//        if(isset($data['rated'])) {
//            $anime->setRated($data['rated']);
//        }
//        if(isset($data['startDate'])) {
//            $anime->setstartDate(new DateTime($data['startDate']));
//        }
//        if(isset($data['endDate'])) {
//            $anime->setEndDate(new DateTime($data['endDate']));
//        }
//        $note->setCreator($user);
//        $note->setHub($hub);
//        return $note;
    }
}
