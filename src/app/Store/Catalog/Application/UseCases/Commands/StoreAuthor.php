<?php

namespace App\Store\Catalog\Application\UseCases\Commands;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Application\Exceptions\AuthorAlreadyExistsException;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class StoreAuthor implements CommandInterface
{
    private AuthorRepositoryInterface $repository;
    private string                    $uuid;

    public function __construct(
        private readonly AuthorData $author
    )
    {
        $this->uuid       = Str::uuid()->toString();
        $this->repository = app()->make(AuthorRepositoryInterface::class);
    }

    public function execute(): void
    {
        $firstName = $this->author->firstName->firstName;
        $lastName  = $this->author->lastName->lastName;

        try {
            if ($this->repository->findByName("$firstName $lastName")) {
                throw new AuthorAlreadyExistsException();
            }
        } catch (ModelNotFoundException $exception) {
        }

        $this->repository->create($this->author, $this->uuid);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
