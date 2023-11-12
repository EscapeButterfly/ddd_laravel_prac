<?php

namespace App\Store\Client\Domain\Repositories;

use App\Store\Client\Application\DTO\ClientData;
use App\Store\Client\Domain\Model\Client;

interface ClientRepositoryInterface
{
    public function create(ClientData $clientData, string $password, ?string $uuid): Client;

    public function update(ClientData $clientData, ?string $password, string $uuid): Client;

    public function getByUuid(string $uuid): Client;

    public function delete(string $uuid): void;
}
