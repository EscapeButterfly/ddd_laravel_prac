<?php

namespace App\Store\Order\Application\UseCases\Commands;

use App\Store\Common\Domain\CommandInterface;
use App\Store\Order\Application\DTO\OrderData;
use App\Store\Order\Domain\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Str;

class CreateOrderCommand implements CommandInterface
{
    private OrderRepositoryInterface $repository;
    private string                   $uuid;

    public function __construct(
        private readonly OrderData $data
    )
    {
        $this->uuid       = Str::uuid()->toString();
        $this->repository = app()->make(OrderRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->create($this->data, $this->uuid);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
