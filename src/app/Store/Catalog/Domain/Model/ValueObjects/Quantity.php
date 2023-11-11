<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Quantity extends ValueObject
{
    public readonly int $value;

    public function __construct(int $quantity)
    {
        $this->value = $quantity;
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }
}
