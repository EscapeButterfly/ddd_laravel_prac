<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;
use Illuminate\Database\Eloquent\Collection;

class FindAllAuthors implements QueryInterface
{
    private AuthorRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function handle(): Collection
    {
        return $this->repository->findAll();
    }
}
