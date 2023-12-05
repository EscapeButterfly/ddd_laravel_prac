<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Catalog\Domain\Enums\Currency as CurrencyEnum;
use App\Store\Common\Domain\ValueObject;

final class Currency extends ValueObject
{
    public readonly string $value;

    public function __construct(CurrencyEnum $currency)
    {
        $this->value = $currency->value;
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
