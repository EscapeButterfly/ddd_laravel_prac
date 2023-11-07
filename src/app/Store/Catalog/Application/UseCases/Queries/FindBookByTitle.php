<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class FindBookByTitle implements QueryInterface
{
    private BookRepositoryInterface $repository;

    public function __construct(
        private readonly string $title
    )
    {
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function handle(): Book
    {
        return $this->repository->findByTitle($this->title);
    }
}
