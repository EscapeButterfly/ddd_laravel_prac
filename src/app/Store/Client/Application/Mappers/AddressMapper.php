<?php

namespace App\Store\Client\Application\Mappers;

use App\Store\Client\Domain\Model\Entities\Address;
use App\Store\Client\Domain\Model\ValueObjects\City;
use App\Store\Client\Domain\Model\ValueObjects\Country;
use App\Store\Client\Domain\Model\ValueObjects\PostalCode;
use App\Store\Client\Domain\Model\ValueObjects\State;
use App\Store\Client\Domain\Model\ValueObjects\Street;
use App\Store\Client\Infrastructure\EloquentModels\Address as AddressEloquent;

class AddressMapper
{
    public static function fromArray(array $address): Address
    {
        return new Address(
            uuid       : $address['uuid'] ?? null,
            client_uuid: $address['client_uuid'] ?? null,
            street     : new Street($address['street']),
            city       : new City($address['city']),
            state      : new State($address['state']),
            country    : new Country($address['country']),
            postalCode : new PostalCode($address['postal_code'])
        );
    }

    public static function fromEloquent(AddressEloquent $address): Address
    {
        return new Address(
            uuid       : $address->uuid,
            client_uuid: $address->client_uuid,
            street     : new Street($address->street),
            city       : new City($address->city),
            state      : new State($address->state),
            country    : new Country($address->country),
            postalCode : new PostalCode($address->postal_code),

        );
    }
}
