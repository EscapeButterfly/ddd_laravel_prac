<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class SearchAuthors implements QueryInterface
{
    private AuthorRepositoryInterface $repository;
    private array                     $params;

    public function __construct(array $params)
    {
        $this->params     = $params;
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function handle(): array
    {
        return $this->repository->search($this->params);
    }
}
