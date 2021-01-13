<?php

namespace App\Finder\Hub;

use App\Entity\Hub\Hub;
use App\Entity\User\User;
use App\Repository\Hub\HubRepositoryInterface;

class HubFinder
{
    private HubRepositoryInterface $hubRepositoryInterface;

    public function __construct (HubRepositoryInterface $hubRepositoryInterface)
    {
        $this->hubRepositoryInterface = $hubRepositoryInterface;
    }

    public function find(Hub $hub)
    {
        return $this->hubRepositoryInterface->findByHub($hub);
    }

}
