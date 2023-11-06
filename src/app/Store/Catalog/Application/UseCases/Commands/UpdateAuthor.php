<?php

namespace App\Store\Catalog\Application\UseCases\Commands;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;

class UpdateAuthor implements CommandInterface
{
    private AuthorRepositoryInterface $repository;

    public function __construct(
        private readonly AuthorData $authorData,
    )
    {
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->update($this->authorData);
    }
}
