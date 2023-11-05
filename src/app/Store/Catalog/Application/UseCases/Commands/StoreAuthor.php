<?php

namespace App\Store\Catalog\Application\UseCases\Commands;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Application\Exceptions\AuthorAlreadyExistsException;
use App\Store\Catalog\Domain\Model\Entities\Author;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StoreAuthor implements CommandInterface
{
    private AuthorRepositoryInterface $repository;

    public function __construct(
        private readonly Author $author
    )
    {
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function execute(): AuthorData
    {
        $firstName  = $this->author->firstName->firstName;
        $secondName = $this->author->secondName->secondName;

        try {
            if ($this->repository->findByName("$firstName $secondName")) {
                throw new AuthorAlreadyExistsException();
            }
        } catch (ModelNotFoundException $exception) {
        }

        return $this->repository->create($this->author);
    }
}
