<?php

namespace App\Store\Order\Application\Mappers;

use App\Store\Order\Domain\Model\Enums\Status;
use App\Store\Order\Domain\Model\Order;
use App\Store\Order\Domain\Model\ValueObjects\OrderItems;
use App\Store\Order\Infrastructure\EloquentModels\Order as OrderEloquent;

class OrderMapper
{
    public static function fromEloquent(OrderEloquent $order): Order
    {
        return new Order(
            uuid        : $order->uuid,
            client_uuid : $order->client_uuid,
            address_uuid: $order->address_uuid,
            items       : new OrderItems(array_map(function ($item) {
                return OrderItemMapper::fromArray($item);
            }, $order->items->toArray())),
            status      : Status::from($order->status)
        );
    }
}
