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

    public function create(ClientData $clientData, string $password, ?string $uuid): Client
    {
        $client = new ClientEloquent(['uuid' => $uuid, 'password' => $password]);
        $client->fill($clientData->toArray());
        $client->save();

        $addresses = array_map(function ($address) {
            return new Address($address->toArray());
        }, $clientData->addresses->value);


        $client->addresses()->saveMany($addresses);

        return ClientMapper::fromEloquent($client);
    }

    public function update(ClientData $clientData, ?string $password, string $uuid): Client
    {
        /** @var ClientEloquent $client */
        $client = ClientEloquent::query()->with(['addresses'])->findOrFail($uuid);
        $client->fill($clientData->toArray());
        if ($password) {
            $client->password = $password;
        }
        $client->save();

        $addresses = array_map(function ($address) {
            return new Address($address->toArray());
        }, $clientData->addresses->value);

        $addressesToDelete = $client->addresses->pluck('uuid')->diff(collect($addresses));
        $client->addresses()->whereIn('uuid', $addressesToDelete)->delete();

        $client->addresses()->saveMany($addresses);

        return ClientMapper::fromEloquent($client);
    }

    public function getByUuid(string $uuid): Client
    {
        /** @var ClientEloquent $client */
        $client = ClientEloquent::query()
            ->with(['addresses'])
            ->findOrFail($uuid);
        return ClientMapper::fromEloquent($client);
    }

    public function delete(string $uuid): void
    {
        $client = ClientEloquent::query()->findOrFail($uuid);
        $client->addresses()->delete();
        $client->delete();
    }
}
