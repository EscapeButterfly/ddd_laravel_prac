<?php

namespace App\Store\Order\Application\DTO;

use App\Store\Order\Domain\Model\Entities\OrderItem;
use App\Store\Order\Domain\Model\Enums\Status;
use App\Store\Order\Domain\Model\ValueObjects\OrderItems;
use Illuminate\Http\Request;

class OrderData
{
    public function __construct(
        public readonly string     $client_uuid,
        public readonly string     $address_uuid,
        public readonly OrderItems $items,
        public readonly Status     $status
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new OrderData(
            client_uuid : $request->input('client_uuid'),
            address_uuid: $request->input('address_uuid'),
            items       : new OrderItems(array_map(function ($item) {
                return new OrderItem($item);
            }, $request->input('order_items'))),
            status      : Status::from($request->input('status') ?? Status::CREATED->value)
        );
    }

    public function toArray(): array
    {
        return [
            'client_uuid'  => $this->client_uuid,
            'address_uuid' => $this->address_uuid,
            'order_items'  => $this->items,
            'status'       => $this->status
        ];
    }
}
