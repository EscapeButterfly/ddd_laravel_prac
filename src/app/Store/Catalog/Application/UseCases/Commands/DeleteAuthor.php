<?php

namespace App\Store\Catalog\Application\UseCases\Commands;

use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;

class DeleteAuthor implements CommandInterface
{
    private AuthorRepositoryInterface $repository;

    public function __construct(
        private readonly string $uuid
    )
    {
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->delete($this->uuid);
    }
}
