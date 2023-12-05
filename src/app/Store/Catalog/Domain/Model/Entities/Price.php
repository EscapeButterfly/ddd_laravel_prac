<?php

namespace App\Store\Catalog\Domain\Model\Entities;

use App\Store\Catalog\Domain\Model\ValueObjects\Currency;
use App\Store\Catalog\Domain\Model\ValueObjects\Price as PriceValueObject;
use App\Store\Common\Domain\Entity;
use Illuminate\Support\Str;

class Price extends Entity
{

    public function __construct(
        public readonly ?string          $uuid,
        public readonly Currency         $currency,
        public readonly PriceValueObject $price
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'     => $this->uuid ?? Str::uuid()->toString(),
            'currency' => $this->currency,
            'price'    => $this->price
        ];
    }
}
