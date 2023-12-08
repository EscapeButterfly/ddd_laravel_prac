<?php

namespace App\Store\Order\Application\UseCases\Queries;

use App\Store\Common\Domain\QueryInterface;
use App\Store\Order\Domain\Model\Order;
use App\Store\Order\Domain\Repositories\OrderRepositoryInterface;

class GetOrderQuery implements QueryInterface
{
    private OrderRepositoryInterface $repository;

    public function __construct(
        private readonly string $uuid
    )
    {
        $this->repository = app()->make(OrderRepositoryInterface::class);
    }

    public function handle(): Order
    {
        return $this->repository->getByUuid($this->uuid);
    }
}
