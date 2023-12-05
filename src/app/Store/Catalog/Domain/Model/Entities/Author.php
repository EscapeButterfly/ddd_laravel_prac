<?php


namespace App\Store\Catalog\Domain\Model\Entities;

use App\Store\Catalog\Domain\Model\ValueObjects\Biography;
use App\Store\Catalog\Domain\Model\ValueObjects\BirthDate;
use App\Store\Catalog\Domain\Model\ValueObjects\FirstName;
use App\Store\Catalog\Domain\Model\ValueObjects\LastName;
use App\Store\Common\Domain\Entity;

class Author extends Entity
{
    public function __construct(
        public ?string            $uuid,
        public readonly FirstName $firstName,
        public readonly LastName  $lastName,
        public readonly BirthDate $birthDate,
        public readonly Biography $biography
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'       => $this->uuid,
            'first_name' => $this->firstName,
            'last_name'  => $this->lastName,
            'birth_date' => $this->birthDate,
            'bio'        => $this->biography
        ];
    }

    public function __toString(): string
    {
        return "$this->firstName $this->lastName";
    }
}
