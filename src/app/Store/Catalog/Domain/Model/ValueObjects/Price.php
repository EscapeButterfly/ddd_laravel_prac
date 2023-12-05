<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Price extends ValueObject
{
    public readonly float $value;

    public function __construct(float $price)
    {
        $this->value = $price;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): float
    {
        return $this->value;
    }
}
