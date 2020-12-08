<?php

namespace App\Controller\Application\Api\Note;

use App\Entity\Hub\Hub;
use App\Entity\Note\Note;
use App\Entity\User\User;
use App\Procedure\Note\NoteCreationProcedure;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @method User getUser()
 */
class NoteController extends AbstractController
{
    private NoteCreationProcedure $noteCreationProcedure;
    public function __construct(NoteCreationProcedure $noteCreationProcedure)
    {
        $this->noteCreationProcedure = $noteCreationProcedure;
    }

    /**
     * @Route(
     *     "/hub/{id}/notes/add",
     *     name="my_note_hub_api_note_add",
     *     methods={"POST"},
     *     options={"expose"=true}
     * )
     * @param Request $request
     * @param Hub $hub
     * @param SerializerInterface $serializer
     * @param PublisherInterface $publisher
     * @return JsonResponse
     * @throws Exception
     */
    public function add(Request $request, Hub $hub, SerializerInterface $serializer, PublisherInterface $publisher)
    {
        $data = $serializer->deserialize($request->getContent(),Note::class, 'json');
        // TODO Improve handler of topics
        return $this->json([
            'data'=> $this->noteCreationProcedure->createNote($hub, $this->getUser(), $data)
        ]);
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
