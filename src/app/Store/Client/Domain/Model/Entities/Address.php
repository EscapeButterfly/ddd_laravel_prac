<?php

namespace App\Store\Client\Domain\Model\Entities;

use App\Store\Client\Domain\Model\ValueObjects\City;
use App\Store\Client\Domain\Model\ValueObjects\Country;
use App\Store\Client\Domain\Model\ValueObjects\PostalCode;
use App\Store\Client\Domain\Model\ValueObjects\State;
use App\Store\Client\Domain\Model\ValueObjects\Street;
use App\Store\Common\Domain\Entity;

class Address extends Entity
{
    public function __construct(
        public ?string             $uuid,
        public readonly string     $client_uuid,
        public readonly Street     $street,
        public readonly City       $city,
        public readonly State      $state,
        public readonly Country    $country,
        public readonly PostalCode $postalCode
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'        => $this->uuid,
            'client_uuid' => $this->client_uuid,
            'street'      => $this->street,
            'state'       => $this->state,
            'country'     => $this->country,
            'postal_code' => $this->postalCode
        ];
    }
}
