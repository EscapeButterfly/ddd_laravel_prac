<?php

namespace App\Store\Client\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class PhoneNumber extends ValueObject
{
    public readonly string $value;

    public function __construct(string $phoneNumber)
    {
        $this->value = $phoneNumber;
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
