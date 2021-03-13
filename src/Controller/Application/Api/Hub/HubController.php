<?php

namespace App\Controller\Application\Api\Hub;

use App\Entity\Hub\Hub;
use App\Repository\Hub\HubRepository;
use App\Serializer\Hub\HubArraySerializer;
use App\Serializer\SymfonySerializerProcess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HubController extends AbstractController
{

    private HubRepository $hubRepository;
    private HubArraySerializer $hubArraySerializer;
    private SymfonySerializerProcess $symfonySerializerProcess;

    public function __construct(
        HubRepository $hubRepository,
        HubArraySerializer $hubArraySerializer,
        SymfonySerializerProcess $symfonySerializerProcess
    ) {
        $this->hubRepository = $hubRepository;
        $this->hubArraySerializer = $hubArraySerializer;
        $this->symfonySerializerProcess = $symfonySerializerProcess;
    }

    /**
     * @Route(
     *     "/hubs",
     *     name="my_note_hub_api_get_hubs",
     *     methods={"GET"},
     *     options={"expose"=true}
     * )
     * @return JsonResponse
     */
    public function getHubs()
    {
        $hubs = $this->hubRepository->findAll();
        return $this->json([
            'data' => $this->hubArraySerializer->listToArray($hubs)
        ]);
    }

    /**
     * @Route(
     *     "/hubs/{id}/hub",
     *     name="my_note_hub_api_get_hub",
     *     methods={"GET"},
     *     options={"expose"=true}
     * )
     * @param Hub $hub
     * @return Response
     */
    public function getHubInformation (Hub $hub)
    {

        return $this->symfonySerializerProcess->list(
            $hub,
            ['id', 'name', 'creationDatetime', 'creator']
        );
    }
}
