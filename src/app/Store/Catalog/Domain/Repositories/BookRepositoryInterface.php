<?php

namespace App\Store\Catalog\Domain\Repositories;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Infrastructure\EloquentModels\Book as BookEloquent;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function findAll(): Collection;

    public function findByUuid(string $uuid): BookEloquent;

    public function findByIsbn(string $isbn): BookEloquent;

    public function findByTitle(string $title): BookEloquent;

    public function create(Book $book): BookData;

    public function update(BookData $bookData): void;

    public function delete(string $uuid): void;
}
