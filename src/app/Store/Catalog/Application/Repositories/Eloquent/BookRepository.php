<?php

namespace App\Store\Catalog\Application\Repositories\Eloquent;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Application\Mappers\BookMapper;
use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Catalog\Infrastructure\EloquentModels\Book as BookEloquent;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BookRepositoryInterface
{

    public function findAll(): Collection
    {
        return BookEloquent::all();
    }

    public function findByUuid(string $uuid): BookEloquent
    {
        /** @var BookEloquent $book */
        $book = BookEloquent::query()->where('uuid', $uuid)->firstOrFail();
        return $book;
    }

    public function findByIsbn(string $isbn): BookEloquent
    {
        /** @var BookEloquent $book */
        $book = BookEloquent::query()->where('isbn', $isbn)->firstOrFail();
        return $book;
    }

    public function findByTitle(string $title): BookEloquent
    {
        /** @var BookEloquent $book */
        $book = BookEloquent::query()->where('title', $title)->firstOrFail();
        return $book;
    }

    public function create(Book $book): BookData
    {
        $bookEloquent = BookMapper::toEloquent($book);
        $bookEloquent->save();
        return BookData::fromEloquent($bookEloquent);
    }

    public function update(BookData $bookData): void
    {
        $bookArray    = $bookData->toArray();
        $bookEloquent = BookEloquent::query()->findOrFail($bookArray['uuid']);
        $bookEloquent->fill($bookArray);
        $bookEloquent->save();
    }

    public function delete(string $uuid): void
    {
        $bookEloquent = BookEloquent::query()->findOrFail($uuid);
        $bookEloquent->delete();
    }
}
