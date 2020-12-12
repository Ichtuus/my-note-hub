<?php

namespace App\Infrastructure\Doctrine\Repository\Hub;

use App\Infrastructure\Doctrine\Entity\Hub\Hub;
use Doctrine\ORM\AbstractQuery;

interface HubRepositoryInterface
{
    const LIMIT = 500;
    const OFFSET = 0;

    public function findByHub(Hub $hub, $limit = self::LIMIT, $hydrationMode = AbstractQuery::HYDRATE_OBJECT);

}
