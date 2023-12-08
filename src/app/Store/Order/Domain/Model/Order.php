<?php

namespace App\Store\Order\Domain\Model;

use App\Store\Common\Domain\AggregateRoot;
use App\Store\Order\Domain\Model\Enums\Status;
use App\Store\Order\Domain\Model\ValueObjects\OrderItems;

class Order extends AggregateRoot
{
    public function __construct(
        public readonly ?string    $uuid,
        public readonly string     $client_uuid,
        public readonly string     $address_uuid,
        public readonly OrderItems $items,
        public readonly Status     $status,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'         => $this->uuid,
            'client_uuid'  => $this->client_uuid,
            'address_uuid' => $this->address_uuid,
            'order_items'  => $this->items,
            'status'       => $this->status
        ];
    }
}
