<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Model\Entities\Author;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class FindAuthorByName implements QueryInterface
{
    private AuthorRepositoryInterface $repository;
    private string                    $name;

    public function __construct(string $name)
    {
        $this->name       = $name;
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function handle(): Author
    {
        return $this->repository->findByName($this->name);
    }
}
