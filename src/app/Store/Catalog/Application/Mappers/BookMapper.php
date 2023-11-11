<?php

namespace App\Store\Catalog\Application\Mappers;

use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Model\ValueObjects\Authors;
use App\Store\Catalog\Domain\Model\ValueObjects\Description;
use App\Store\Catalog\Domain\Model\ValueObjects\Genres;
use App\Store\Catalog\Domain\Model\ValueObjects\Isbn;
use App\Store\Catalog\Domain\Model\ValueObjects\Pages;
use App\Store\Catalog\Domain\Model\ValueObjects\PublishDate;
use App\Store\Catalog\Domain\Model\ValueObjects\Quantity;
use App\Store\Catalog\Domain\Model\ValueObjects\Title;
use App\Store\Catalog\Infrastructure\EloquentModels\Book as BookEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookMapper
{
    public static function fromRequest(Request $request, string $uuid): Book
    {
        return new Book(
            uuid       : $uuid,
            title      : new Title($request->input('title')),
            isbn       : new Isbn($request->input('isbn')),
            description: new Description($request->input('description')),
            pages      : new Pages($request->input('pages')),
            publishDate: new PublishDate(Carbon::parse($request->input('publish_date'))->toDateTimeImmutable()),
            genres     : new Genres($request->input('genres')),
            authors    : new Authors($request->input('authors')),
            quantity   : new Quantity($request->input('quantity'))
        );
    }

    public static function fromEloquent(BookEloquent $book): Book
    {
        return new Book(
            uuid       : $book->uuid,
            title      : new Title($book->title),
            isbn       : new Isbn($book->isbn),
            description: new Description($book->description),
            pages      : new Pages($book->pages),
            publishDate: new PublishDate(Carbon::parse($book->publish_date)->toDateTimeImmutable()),
            genres     : new Genres($book->genres->map(function ($genre) {
                return GenreMapper::fromEloquent($genre);
            })->toArray()),
            authors    : new Authors($book->authors->map(function ($author) {
                return AuthorMapper::fromEloquent($author);
            })->toArray()),
            quantity   : new Quantity($book->quantity)
        );
    }

    public static function fromArray(array $book): Book
    {
        $bookModel       = new BookEloquent($book);
        $bookModel->uuid = $book['uuid'] ?? null;
        return self::fromEloquent($bookModel);
    }

    public static function toEloquent(Book $book): BookEloquent
    {
        $bookEloquent = new BookEloquent();
        if ($book->uuid) {
            $bookEloquent = BookEloquent::query()->findOrFail($book->uuid);
        }
        $bookEloquent->isbn         = $book->isbn;
        $bookEloquent->title        = $book->title;
        $bookEloquent->description  = $book->description;
        $bookEloquent->pages        = $book->pages;
        $bookEloquent->publish_date = $book->publishDate;
        $bookEloquent->quantity     = $book->quantity;

        return $bookEloquent;
    }
}
