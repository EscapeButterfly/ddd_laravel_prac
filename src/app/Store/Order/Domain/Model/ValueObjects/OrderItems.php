<?php

namespace App\Store\Order\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObjectArray;
use App\Store\Order\Domain\Exceptions\NotValidItemException;
use App\Store\Order\Domain\Model\Entities\OrderItem;

class OrderItems extends ValueObjectArray
{
    public readonly array $value;

    public function __construct(array $items)
    {
        parent::__construct($items);

        foreach ($items as $item) {
            if (!$item instanceof OrderItem) {
                throw new NotValidItemException;
            }
        }
        $this->value = $items;
    }

    public function jsonSerialize(): array
    {
        return $this->value;
    }
}
