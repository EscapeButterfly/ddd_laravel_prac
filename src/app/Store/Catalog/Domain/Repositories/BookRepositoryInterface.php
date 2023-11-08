<?php

namespace App\Store\Catalog\Domain\Repositories;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Domain\Model\Book;


interface BookRepositoryInterface
{
    public function findAll(): array;

    public function findByUuid(string $uuid): Book;

    public function findByIsbn(string $isbn): Book;

    public function findByTitle(string $title): array;

    public function create(BookData $bookData, ?string $uuid): Book;

    public function update(BookData $bookData, string $uuid): void;

    public function delete(string $uuid): void;
}
