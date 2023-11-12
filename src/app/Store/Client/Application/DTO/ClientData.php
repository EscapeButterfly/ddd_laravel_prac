<?php

namespace App\Store\Client\Application\DTO;

use App\Store\Client\Application\Mappers\AddressMapper;
use App\Store\Client\Domain\Model\Entities\Address;
use App\Store\Client\Domain\Model\ValueObjects\Addresses;
use App\Store\Client\Domain\Model\ValueObjects\Email;
use App\Store\Client\Domain\Model\ValueObjects\FirstName;
use App\Store\Client\Domain\Model\ValueObjects\LastName;
use App\Store\Client\Domain\Model\ValueObjects\Password;
use App\Store\Client\Domain\Model\ValueObjects\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientData
{
    public function __construct(
        public readonly Email       $email,
        public readonly FirstName   $firstName,
        public readonly LastName    $lastName,
        public readonly PhoneNumber $phoneNumber,
        public readonly Addresses   $addresses
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            email      : new Email($request->input('email')),
            firstName  : new FirstName($request->input('first_name')),
            lastName   : new LastName($request->input('last_name')),
            phoneNumber: new PhoneNumber($request->input('phone_number')),
            addresses  : new Addresses(array_map(function ($address) {
                return AddressMapper::fromArray($address);
            }, $request->input('addresses')))
        );
    }

    public static function fromEloquent(): self
    {
        return new self(
        //TODO
        );
    }

    public function toArray(): array
    {
        return [
            'email'        => $this->email->value,
            'first_name'   => $this->firstName->value,
            'last_name'    => $this->lastName->value,
            'phone_number' => $this->phoneNumber->value,
            'addresses'    => $this->addresses->value
        ];
    }
}
