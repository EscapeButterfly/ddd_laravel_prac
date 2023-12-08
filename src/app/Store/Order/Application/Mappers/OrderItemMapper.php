<?php

namespace App\Store\Order\Application\Mappers;

use App\Store\Order\Domain\Model\Entities\OrderItem;
use App\Store\Order\Infrastructure\EloquentModels\OrderItem as OrderItemEloquent;

class OrderItemMapper
{
    public static function fromEloquent(OrderItemEloquent $item): OrderItem
    {
        return new OrderItem($item->book_uuid);
    }

    public static function fromArray(array $item): OrderItem
    {
        return new OrderItem($item['book_uuid']);
    }
}
