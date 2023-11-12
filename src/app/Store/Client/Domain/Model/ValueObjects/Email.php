<?php

namespace App\Store\Client\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Email extends ValueObject
{
    public readonly string $value;

    public function __construct(string $email)
    {
        $this->value = $email;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
