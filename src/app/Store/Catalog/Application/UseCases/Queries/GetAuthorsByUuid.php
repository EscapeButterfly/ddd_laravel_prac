<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class GetAuthorsByUuid implements QueryInterface
{
    private AuthorRepositoryInterface $repository;

    public function __construct(
        public readonly array $authorsUuids
    )
    {
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function handle(): array
    {
        return $this->repository->findByUuids($this->authorsUuids);
    }
}
