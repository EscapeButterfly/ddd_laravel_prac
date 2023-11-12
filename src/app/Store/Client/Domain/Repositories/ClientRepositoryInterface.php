<?php

namespace App\Store\Client\Domain\Repositories;

use App\Store\Client\Application\DTO\ClientData;
use App\Store\Client\Domain\Model\Client;

interface ClientRepositoryInterface
{
    public function create(ClientData $clientData, ?string $uuid): Client;

    public function getByUuid(string $uuid): Client;
}
