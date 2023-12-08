<?php

namespace App\Store\Order\Application\Repositories\Eloquent;

use App\Store\Order\Application\DTO\OrderData;
use App\Store\Order\Application\Mappers\OrderMapper;
use App\Store\Order\Domain\Model\Order;
use App\Store\Order\Domain\Repositories\OrderRepositoryInterface;
use App\Store\Order\Infrastructure\EloquentModels\Order as OrderEloquent;

class OrderRepository implements OrderRepositoryInterface
{

    public function create(OrderData $data, string $uuid): Order
    {
        $order = new OrderEloquent(['uuid' => $uuid]);
        $order->fill($data->toArray());
        $order->status = $data->status->value;
        $order->save();

        $items = array_map(fn($item) => ['book_uuid' => $item->book_uuid], $data->items->value);
        $order->items()->createMany($items);

        return OrderMapper::fromEloquent($order);
    }

    public function update(OrderData $data, string $uuid): Order
    {
        // TODO: Implement update() method.
    }

    public function getByUuid(string $uuid): Order
    {
        return OrderMapper::fromEloquent(OrderEloquent::query()->where('uuid', $uuid)->firstOrFail());
    }

    public function delete(string $uuid): void
    {
        // TODO: Implement delete() method.
    }
}
