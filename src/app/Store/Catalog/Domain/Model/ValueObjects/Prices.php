<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Catalog\Domain\Exception\NotValidPriceException;
use App\Store\Catalog\Domain\Model\Entities\Price as PriceEntity;
use App\Store\Common\Domain\ValueObjectArray;

final class Prices extends ValueObjectArray
{
    public readonly array $value;

    public function __construct(array $prices)
    {
        parent::__construct($prices);

        foreach ($prices as $price) {
            if (!$price instanceof PriceEntity) {
                throw new NotValidPriceException;
            }
        }
        $this->value = $prices;
    }

    public function jsonSerialize(): array
    {
        return $this->value;
    }
}
