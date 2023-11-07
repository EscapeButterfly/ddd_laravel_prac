<?php

namespace App\Store\Catalog\Application\Repositories\Eloquent;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Application\Mappers\BookMapper;
use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Catalog\Infrastructure\EloquentModels\Book as BookEloquent;

class BookRepository implements BookRepositoryInterface
{

    public function findAll(): array
    {
        $bookCollection = BookEloquent::query()->with(['authors', 'genres'])->get();
        return $bookCollection->map(function (BookEloquent $book) {
            return BookMapper::fromEloquent($book);
        })->toArray();
    }

    public function findByUuid(string $uuid): Book
    {
        /** @var BookEloquent $book */
        $book = BookEloquent::query()
            ->with(['genres', 'authors'])
            ->where('uuid', $uuid)
            ->firstOrFail();
        return BookMapper::fromEloquent($book);
    }

    public function findByIsbn(string $isbn): Book
    {
        /** @var BookEloquent $book */
        $book = BookEloquent::query()
            ->with(['genres', 'authors'])
            ->where('isbn', $isbn)
            ->firstOrFail();
        return BookMapper::fromEloquent($book);
    }

    public function findByTitle(string $title): Book
    {
        /** @var BookEloquent $book */
        $book = BookEloquent::query()
            ->with(['genres', 'authors'])
            ->where('title', $title)
            ->firstOrFail();
        return BookMapper::fromEloquent($book);
    }

    public function create(BookData $bookData, ?string $uuid): Book
    {
        $book = new BookEloquent(['uuid' => $uuid]);
        $book->fill($bookData->toArray());
        $book->save();
        return BookMapper::fromEloquent($book);
    }

    public function update(BookData $bookData, string $uuid): void
    {
        $bookArray    = $bookData->toArray();
        $bookEloquent = BookEloquent::query()->findOrFail($uuid);
        $bookEloquent->fill($bookArray);
        $bookEloquent->save();
    }

    public function delete(string $uuid): void
    {
        $bookEloquent = BookEloquent::query()->findOrFail($uuid);
        $bookEloquent->delete();
    }
}
