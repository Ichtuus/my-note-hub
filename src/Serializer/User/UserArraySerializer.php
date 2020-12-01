<?php

namespace App\Serializer\User;

use App\Entity\User\User;
use App\Serializer\Hub\HubArraySerializer;

class UserArraySerializer
{
    private HubArraySerializer $hubArraySerializer;

    public function __construct(
        HubArraySerializer $hubArraySerializer
    ) {
        $this->hubArraySerializer = $hubArraySerializer;
    }
    public function toArray(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'hub' => $this->hubArraySerializer->toArray($user->getHub()),
            'user_authenticated' => $user ? true : false
        ];
    }
}
