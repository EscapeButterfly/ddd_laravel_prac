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
        $genres      = $book->genres->pluck('genre');
        $authors     = $book->authors->map(function ($item) {
            return $item['first_name'] . ' ' . $item['second_name'];
        });
        $publishDate = Carbon::parse($book->publish_date)->toDateTimeImmutable();

        return new Book(
            uuid       : $book->uuid,
            title      : new Title($book->title),
            isbn       : new Isbn($book->isbn),
            description: new Description($book->description),
            pages      : new Pages($book->pages),
            publishDate: new PublishDate($publishDate),
            genres     : new Genres($genres),
            authors    : new Authors($authors->toArray()),
            quantity   : new Quantity($book->quantity)
        );
    }

    /*public static function fromArray(): Book
    {

    }

    public static function toEloquent(): BookEloquent
    {

    }*/
}
