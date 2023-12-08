<?php

namespace App\Store\Order\Domain\Model\Entities;

use App\Store\Common\Domain\Entity;

class OrderItem extends Entity
{
    public function __construct(
        public readonly string $book_uuid
    )
    {
    }

    public function toArray(): array
    {
        return [
            'book_uuid'  => $this->book_uuid
        ];
    }
}
