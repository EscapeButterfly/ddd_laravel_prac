<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class FindBookByIsbn implements QueryInterface
{
    private BookRepositoryInterface $repository;

    public function __construct(
        private readonly string $isbn
    )
    {
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function handle(): Book
    {
        return $this->repository->findByIsbn($this->isbn);
    }
}
