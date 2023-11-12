<?php

namespace App\Store\Client\Application\Repositories\Eloquent;

use App\Store\Client\Application\DTO\ClientData;
use App\Store\Client\Application\Mappers\ClientMapper;
use App\Store\Client\Domain\Model\Client;
use App\Store\Client\Domain\Repositories\ClientRepositoryInterface;
use App\Store\Client\Infrastructure\EloquentModels\Address;
use App\Store\Client\Infrastructure\EloquentModels\Client as ClientEloquent;

class ClientRepository implements ClientRepositoryInterface
{

    public function create(ClientData $clientData, ?string $uuid): Client
    {
        $client = new ClientEloquent(['uuid' => $uuid]);
        $client->fill($clientData->toArray());
        $client->save();

        $addresses = array_map(function ($address) {
            return new Address($address);
        }, $clientData->addresses->toArray());

        $client->addresses()->saveMany($addresses);

        return ClientMapper::fromEloquent($client);
    }

    public function getByUuid(string $uuid): Client
    {
        /** @var ClientEloquent $client */
        $client = ClientEloquent::query()
            ->with(['addresses'])
            ->where('uuid', $uuid)
            ->firstOrFail();
        return ClientMapper::fromEloquent($client);
    }
}
