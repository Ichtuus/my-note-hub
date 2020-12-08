<?php

namespace App\Helper\Format\Hub;

use App\Entity\User\User;
use App\Helper\Format\StringFormatHelper;

class HubHelper
{
    private StringFormatHelper $stringFormatHelper;

    public function __construct(StringFormatHelper $stringFormatHelper)
    {
        $this->stringFormatHelper = $stringFormatHelper;
    }

    /**
     * @param User $user
     * @return string
     */
    public function customHubName(User $user)
    {
        return trim(strtolower($this->stringFormatHelper->removeAccent($user->getUsername())));
    }
}
