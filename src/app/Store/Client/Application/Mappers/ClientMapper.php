<?php

namespace App\Store\Client\Application\Mappers;

use App\Store\Client\Domain\Model\Client;
use App\Store\Client\Domain\Model\ValueObjects\Addresses;
use App\Store\Client\Domain\Model\ValueObjects\Email;
use App\Store\Client\Domain\Model\ValueObjects\FirstName;
use App\Store\Client\Domain\Model\ValueObjects\LastName;
use App\Store\Client\Domain\Model\ValueObjects\PhoneNumber;
use App\Store\Client\Infrastructure\EloquentModels\Client as ClientEloquent;
use Illuminate\Http\Request;

class ClientMapper
{
    public static function fromRequest(Request $request, string $uuid): Client
    {
        return new Client(
            uuid       : $uuid,
            email      : new Email($request->input('email')),
            firstName  : new FirstName($request->input('first_name')),
            lastName   : new LastName($request->input('last_name')),
            phoneNumber: new PhoneNumber($request->input('phone_number')),
            addresses  : new Addresses(array_map(function ($address) {
                return AddressMapper::fromArray($address);
            }, $request->input('addresses')))
        );
    }

    public static function fromEloquent(ClientEloquent $client): Client
    {
        return new Client(
            uuid       : $client->uuid,
            email      : new Email($client->email),
            firstName  : new FirstName($client->first_name),
            lastName   : new LastName($client->last_name),
            phoneNumber: new PhoneNumber($client->phone_number),
            addresses  : new Addresses(array_map(function ($address) {
                return AddressMapper::fromArray($address);
            }, $client->addresses->toArray()))
        );
    }

    public static function fromArray(array $client): Client
    {
        $clientModel       = new ClientEloquent($client);
        $clientModel->uuid = $client['uuid'] ?? null;
        return self::fromEloquent($clientModel);
    }

    public static function toEloquent(Client $client): ClientEloquent
    {
        $clientEloquent = new ClientEloquent();
        if ($client->uuid) {
            $clientEloquent = ClientEloquent::query()->findOrFail($client->uuid);
        }
        $clientEloquent->email        = $client->email->value;
        $clientEloquent->first_name   = $client->firstName->value;
        $clientEloquent->last_name    = $client->lastName->value;
        $clientEloquent->phone_number = $client->phoneNumber->value;

        return $clientEloquent;
    }
}
