<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Quantity extends ValueObject
{
    public readonly int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function jsonSerialize(): int
    {
        return $this->quantity;
    }
}
