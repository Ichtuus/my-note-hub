<?php

namespace App\Serializer\Note;

use App\Entity\Note\Note;

class NoteArraySerializer
{
    /**
     * @param $notes
     * @return array
     */
    public function listToArray($notes)
    {
        $result = [];
        foreach ($notes as $note) {
            $result[] = $this->toArray($note);
        }

        return $result;
    }

    /**
     * @param Note $note
     * @return array
     */
    public function toArray(Note $note)
    {
        return [
            'id' => $note->getId(),
            'note_title' => $note->getNoteTitle(),
            'note_content' => $note->getNoteContent(),
            'creation_datetime' => $note->getCreationDatetime(),
            'note_first_link' => $note->getNoteFirstLink(),
            'note_second_link' => $note->getNoteSecondLink(),
            'note_third_link' => $note->getNoteThirdLink()
        ];
    }
}
