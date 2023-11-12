<?php

namespace App\Store\Client\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Country extends ValueObject
{
    public readonly string $value;

    public function __construct(string $country)
    {
        return $this->value = $country;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
