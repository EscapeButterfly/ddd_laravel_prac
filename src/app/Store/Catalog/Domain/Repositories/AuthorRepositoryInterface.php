<?php

namespace App\Store\Catalog\Domain\Repositories;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Domain\Model\Entities\Author;

interface AuthorRepositoryInterface
{
    public function findAll();
    public function findByUuid(string $uuid);
    public function findByName(string $name);
    public function create(Author $author);
    public function update(AuthorData $authorData);
    public function delete(string $uuid);
}
