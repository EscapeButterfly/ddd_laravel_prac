<?php

namespace App\Store\Catalog\Domain\Repositories;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Domain\Model\Book;

interface BookRepositoryInterface
{
    public function findAll();
    public function findByUuid(string $uuid);
    public function findByIsbn(string $isbn);
    public function findByTitle(string $title);

    public function create(Book $book);
    public function update(BookData $bookData);
    public function delete(string $uuid);
}
