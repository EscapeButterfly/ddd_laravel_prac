<?php

namespace App\Store\Catalog\Domain\Repositories;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Domain\Model\Entities\Author;

interface AuthorRepositoryInterface
{
    public function findAll(): array;

    public function findByUuid(string $uuid): Author;

    public function findByName(string $name): Author;

    public function search(array $params = null): array;

    public function create(AuthorData $authorData, ?string $uuid): Author;

    public function update(AuthorData $authorData, string $uuid): void;

    public function delete(string $uuid): void;
}
