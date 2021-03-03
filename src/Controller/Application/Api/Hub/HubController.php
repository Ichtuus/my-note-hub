<?php

namespace App\Controller\Application\Api\Hub;

use App\Repository\Hub\HubRepository;
use App\Serializer\Hub\HubArraySerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HubController extends AbstractController
{

    private HubRepository $hubRepository;
    private HubArraySerializer $hubArraySerializer;

    public function __construct(
        HubRepository $hubRepository,
        HubArraySerializer $hubArraySerializer
    ) {
        $this->hubRepository = $hubRepository;
        $this->hubArraySerializer = $hubArraySerializer;
    }

    /**
     * @Route(
     *     "/hubs",
     *     name="my_note_hub_api_hub_get",
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
}
