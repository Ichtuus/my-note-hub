<?php

namespace App\Controller\Application\Api\Note;

use App\Entity\Note\Note;
use App\Procedure\Note\NoteCreationProcedure;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class NoteController extends AbstractController
{
    private NoteCreationProcedure $noteCreationProcedure;
    public function __construct(NoteCreationProcedure $noteCreationProcedure)
    {
        $this->noteCreationProcedure = $noteCreationProcedure;
    }

    /**
     * @Route(
     *     "/hub/notes/add",
     *     name="my_note_hub_api_note_add",
     *     methods={"POST"},
     *     options={"expose"=true}
     * )
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param PublisherInterface $publisher
     * @return Response
     */
    public function add(Request $request, SerializerInterface $serializer, PublisherInterface $publisher)
    {
        $data = $serializer->deserialize($request->getContent(),Note::class, 'json');
//        TODO Improve handler of topics
            $this->noteCreationProcedure->createNote($data);
//        $update = new Update(
//            'my-note-hub.localhost/note',
//            json_encode(
//                [
//                    'note' => $data
//                ]
//            )
//        );
//
//        // The Publisher service is an invokable object
//        $publisher($update);
//
//        return new Response('published!');
    }

}
