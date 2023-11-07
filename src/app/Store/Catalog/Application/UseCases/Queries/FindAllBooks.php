<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class FindAllBooks implements QueryInterface
{
    private BookRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function handle(): array
    {
        return $this->repository->findAll();
    }
}
