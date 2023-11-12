<?php

namespace App\Store\Client\Application\Mappers;

use App\Store\Client\Domain\Model\Client;
use App\Store\Client\Domain\Model\ValueObjects\Addresses;
use App\Store\Client\Domain\Model\ValueObjects\Email;
use App\Store\Client\Domain\Model\ValueObjects\FirstName;
use App\Store\Client\Domain\Model\ValueObjects\LastName;
use App\Store\Client\Domain\Model\ValueObjects\Password;
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
            password   : new Password($request->input('password')),
            firstName  : new FirstName($request->input('first_name')),
            lastName   : new LastName($request->input('last_name')),
            phoneNumber: new PhoneNumber($request->input('phone_number')),
            addresses  : new Addresses($request->input('addresses'))
        );
    }

    public static function fromEloquent(ClientEloquent $client): Client
    {
        return new Client(
            uuid       : $client->uuid,
            email      : new Email($client->email),
            password   : new Password($client->password),
            firstName  : new FirstName($client->first_name),
            lastName   : new LastName($client->last_name),
            phoneNumber: new PhoneNumber($client->phone_number),
            addresses  : new Addresses($client->addresses->toArray())
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
        return new ClientEloquent();
        //TODO
    }
}
