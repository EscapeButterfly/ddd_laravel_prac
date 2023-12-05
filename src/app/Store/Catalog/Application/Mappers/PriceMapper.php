<?php

namespace App\Store\Catalog\Application\Mappers;

use App\Store\Catalog\Domain\Enums\Currency as CurrencyEnum;
use App\Store\Catalog\Domain\Model\Entities\Price;
use App\Store\Catalog\Domain\Model\ValueObjects\Currency;
use App\Store\Catalog\Domain\Model\ValueObjects\Price as PriceValue;
use App\Store\Catalog\Infrastructure\EloquentModels\Price as PriceEloquent;

class PriceMapper
{
    public static function fromArray(array $price): Price
    {
        return new Price(
            uuid    : $price['uuid'] ?? null,
            currency: new Currency(CurrencyEnum::from($price['currency'])),
            price   : new PriceValue($price['price'])
        );
    }

    public static function fromEloquent(PriceEloquent $price): Price
    {
        return new Price(
            uuid    : $price->uuid,
            currency: new Currency(CurrencyEnum::from($price->currency)),
            price   : new PriceValue($price->price)
        );
    }
}
