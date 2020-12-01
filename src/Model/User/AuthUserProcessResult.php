<?php

namespace App\Model\User;

use App\Entity\Hub\Hub;
use App\Entity\Hub\HubUserRole;
use App\Entity\User\User;

class AuthUserProcessResult
{
    public User $user;
    public Hub $hub;
    public HubUserRole $hubUserRole;
}
