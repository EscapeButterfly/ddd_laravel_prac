<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\Entities;

use App\Store\Catalog\Domain\Model\ValueObjects\Biography;
use App\Store\Catalog\Domain\Model\ValueObjects\BirthDate;
use App\Store\Catalog\Domain\Model\ValueObjects\FirstName;
use App\Store\Catalog\Domain\Model\ValueObjects\SecondName;
use App\Store\Common\Domain\Entity;

class Author extends Entity
{
    public function __construct(
        public ?string             $uuid,
        public readonly FirstName  $firstName,
        public readonly SecondName $secondName,
        public readonly BirthDate  $birthDate,
        public readonly Biography  $biography
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'        => $this->uuid,
            'first_name'  => $this->firstName,
            'second_name' => $this->secondName,
            'birth_date'  => $this->birthDate,
            'bio'         => $this->biography
        ];
    }

    public function __toString(): string
    {
        return "$this->firstName $this->secondName";
    }
}
