<?php

namespace App\Store\Client\Application\UseCases\Commands;

use App\Store\Client\Domain\Repositories\ClientRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;

class DeleteClient implements CommandInterface
{
    private ClientRepositoryInterface $repository;

    public function __construct(
        private readonly string $uuid
    )
    {
        $this->repository = app()->make(ClientRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->delete($this->uuid);
    }
}
