<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class FindBookByUuid implements QueryInterface
{
    private BookRepositoryInterface $repository;

    public function __construct(
        private readonly string $uuid
    )
    {
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function handle(): Book
    {
        return $this->repository->findByUuid($this->uuid);
    }
}
