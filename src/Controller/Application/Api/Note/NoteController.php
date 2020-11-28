<?php

namespace App\Controller\Application\Api\Note;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    /**
     * @Route(
     *     "/hub/notes/add",
     *     name="my_note_hub_api_note_add",
     *     methods={"POST"},
     *     options={"expose"=true}
     * )
     * @param Request $request
     */
    public function add(Request $request)
    {
        $data = $request->getContent();
        dump($data); die();
    }

}
