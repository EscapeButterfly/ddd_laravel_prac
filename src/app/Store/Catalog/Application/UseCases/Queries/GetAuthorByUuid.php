<?php

namespace App\Store\Catalog\Application\UseCases\Queries;

use App\Store\Catalog\Domain\Model\Entities\Author;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class GetAuthorByUuid implements QueryInterface
{
    private AuthorRepositoryInterface $repository;
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function handle(): Author
    {
        return $this->repository->findByUuid($this->uuid);
    }
}
