<?php

namespace App\Store\Catalog\Application\Repositories\Eloquent;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Application\Mappers\BookMapper;
use App\Store\Catalog\Application\Mappers\GenreMapper;
use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Catalog\Infrastructure\EloquentModels\Book as BookEloquent;
use App\Store\Catalog\Infrastructure\EloquentModels\Genre;

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

    public function findByTitle(string $title): array
    {
        /** @var BookEloquent $book */
        $bookCollection = BookEloquent::query()
            ->with(['genres', 'authors'])
            ->where('title', 'LIKE', "%$title%")
            ->get();
        return $bookCollection->map(function ($bookEloquent) {
            return BookMapper::fromEloquent($bookEloquent);
        })->toArray();
    }

    public function getGenres(): array
    {
        return Genre::query()
            ->get()
            ->map(function ($genre) {
                return GenreMapper::fromEloquent($genre);
            })->toArray();
    }

    public function getGenresByUuid(array $genres): array
    {
        return Genre::query()
            ->whereIn('uuid', $genres)
            ->get()
            ->map(function ($genre) {
                return GenreMapper::fromEloquent($genre);
            })->toArray();
    }

    public function create(BookData $bookData, ?string $uuid): Book
    {
        $book = new BookEloquent(['uuid' => $uuid]);
        $book->fill($bookData->toArray());
        $book->save();

        $authorsUuid = array_map(function ($author) {
            return $author->uuid;
        }, $bookData->authors->value);

        $genresUuid = array_map(function ($genre) {
            return $genre->uuid;
        }, $bookData->genres->value);

        $book->authors()->attach($authorsUuid);
        $book->genres()->attach($genresUuid);

        return BookMapper::fromEloquent($book);
    }

    public function update(BookData $bookData, string $uuid): void
    {
        $bookArray    = $bookData->toArray();
        $bookEloquent = BookEloquent::query()->findOrFail($uuid);
        $bookEloquent->fill($bookArray);
        $bookEloquent->save();

        $authorsUuid = array_map(function ($author) {
            return $author->uuid;
        }, $bookData->authors->value);

        $genresUuid = array_map(function ($genre) {
            return $genre->uuid;
        }, $bookData->genres->value);

        $bookEloquent->authors()->sync($authorsUuid);
        $bookEloquent->genres()->sync($genresUuid);
    }

    public function delete(string $uuid): void
    {
        $bookEloquent = BookEloquent::query()->findOrFail($uuid);
        $bookEloquent->delete();
    }
}
