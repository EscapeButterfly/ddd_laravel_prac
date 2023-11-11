<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class GetGenresByUuid implements QueryInterface
{
    private BookRepositoryInterface $repository;

    public function __construct(
        public readonly array $uuids
    )
    {
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function handle(): array
    {
        return $this->repository->getGenresByUuid($this->uuids);
    }
}
