<?php

namespace App\Message\Contracts;

interface SendersMessengerInterface
{
    public function getSenders(): ?array;
}
