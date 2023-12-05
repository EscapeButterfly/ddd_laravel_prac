<?php


namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class FirstName extends ValueObject
{
    public readonly string $value;

    public function __construct(string $firstName)
    {
        $this->value = $firstName;
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
