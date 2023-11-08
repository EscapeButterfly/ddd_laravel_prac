<?php

namespace App\Store\Catalog\Application\UseCases\Commands;

use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;

class DeleteBook implements CommandInterface
{
    private BookRepositoryInterface $repository;

    public function __construct(
        private readonly string $uuid
    )
    {
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->delete($this->uuid);
    }
}
