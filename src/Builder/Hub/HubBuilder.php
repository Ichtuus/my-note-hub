<?php


namespace App\Builder\Hub;


use App\Entity\Hub\Hub;
use App\Entity\User\User;
use App\Helper\Format\Hub\HubHelper;

class HubBuilder
{
    private HubHelper $hubHelper;

    public function __construct(
        HubHelper $hubHelper
    ) {
        $this->hubHelper = $hubHelper;
    }

    // Pass user because by default, hub name is username
    public function buildHub(User $user)
    {
        $hub = new Hub();
        $hub->setName($this->hubHelper->customHubName($user));

        return $hub;
    }

}
