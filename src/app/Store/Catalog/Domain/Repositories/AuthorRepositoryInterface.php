<?php

namespace App\Store\Catalog\Domain\Repositories;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Domain\Model\Entities\Author;
use Illuminate\Database\Eloquent\Collection;

interface AuthorRepositoryInterface
{
    public function findAll(): Collection;

    public function findByUuid(string $uuid): Author;

    public function findByName(string $name): Author;

    public function search(array $params = null): Collection;

    public function create(Author $author): AuthorData;

    public function update(AuthorData $authorData): void;

    public function delete(string $uuid): void;
}
