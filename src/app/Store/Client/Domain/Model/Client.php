<?php

namespace App\Store\Client\Domain\Model;


use App\Store\Client\Domain\Model\ValueObjects\Addresses;
use App\Store\Client\Domain\Model\ValueObjects\Email;
use App\Store\Client\Domain\Model\ValueObjects\FirstName;
use App\Store\Client\Domain\Model\ValueObjects\LastName;
use App\Store\Client\Domain\Model\ValueObjects\Password;
use App\Store\Client\Domain\Model\ValueObjects\PhoneNumber;
use App\Store\Common\Domain\AggregateRoot;

class Client extends AggregateRoot
{

    public function __construct(
        public readonly ?string     $uuid,
        public readonly Email       $email,
        public readonly FirstName   $firstName,
        public readonly LastName    $lastName,
        public readonly PhoneNumber $phoneNumber,
        public readonly Addresses   $addresses
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'         => $this->uuid,
            'email'        => $this->email,
            'first_name'   => $this->firstName,
            'last_name'    => $this->lastName,
            'phone_number' => $this->phoneNumber,
            'addresses'    => $this->addresses
        ];
    }
}
