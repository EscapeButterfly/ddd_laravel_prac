<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class LastName extends ValueObject
{
    public readonly string $lastName;

    public function __construct(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function jsonSerialize(): string
    {
        return $this->lastName;
    }

    public function __toString(): string
    {
        return $this->lastName;
    }
}
