<?php

namespace App\Store\Order\Domain\Repositories;

use App\Store\Order\Application\DTO\OrderData;
use App\Store\Order\Domain\Model\Order;

interface OrderRepositoryInterface
{
    public function create(OrderData $data, string $uuid): Order;

    public function update(OrderData $data, string $uuid): Order;

    public function getByUuid(string $uuid): Order;

    public function delete(string $uuid): void;
}
