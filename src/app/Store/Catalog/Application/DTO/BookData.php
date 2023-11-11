<?php

namespace App\Store\Catalog\Application\DTO;

use App\Store\Catalog\Application\Mappers\AuthorMapper;
use App\Store\Catalog\Application\Mappers\GenreMapper;
use App\Store\Catalog\Application\UseCases\Queries\GetAuthorsByUuid;
use App\Store\Catalog\Application\UseCases\Queries\GetGenresByUuid;
use App\Store\Catalog\Domain\Model\ValueObjects\Authors;
use App\Store\Catalog\Domain\Model\ValueObjects\Description;
use App\Store\Catalog\Domain\Model\ValueObjects\Genres;
use App\Store\Catalog\Domain\Model\ValueObjects\Isbn;
use App\Store\Catalog\Domain\Model\ValueObjects\Pages;
use App\Store\Catalog\Domain\Model\ValueObjects\PublishDate;
use App\Store\Catalog\Domain\Model\ValueObjects\Quantity;
use App\Store\Catalog\Domain\Model\ValueObjects\Title;
use App\Store\Catalog\Infrastructure\EloquentModels\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookData
{
    public function __construct(
        public readonly Isbn        $isbn,
        public readonly Title       $title,
        public readonly Description $description,
        public readonly Pages       $pages,
        public readonly PublishDate $publishDate,
        public readonly Quantity    $quantity,
        public readonly Authors     $authors,
        public readonly Genres      $genres
    )
    {
    }

    public static function fromRequest(Request $request): BookData
    {
        return new self(
            isbn       : new Isbn($request->input('isbn')),
            title      : new Title($request->input('title')),
            description: new Description($request->input('description')),
            pages      : new Pages($request->input('pages')),
            publishDate: new PublishDate(Carbon::parse($request->input('publish_date'))->toDateTimeImmutable()),
            quantity   : new Quantity($request->input('quantity')),
            authors    : new Authors((new GetAuthorsByUuid($request->input('authors')))->handle()),
            genres     : new Genres((new GetGenresByUuid($request->input('genres')))->handle())
        );
    }

    public static function fromEloquent(Book $book): BookData
    {
        $authors = $book->authors->map(function ($author) {
            return AuthorMapper::fromEloquent($author);
        })->toArray();
        $genres  = $book->genres->map(function ($genre) {
            return GenreMapper::fromEloquent($genre);
        })->toArray();
        return new self(
            isbn       : new Isbn($book->isbn),
            title      : new Title($book->title),
            description: new Description($book->description),
            pages      : new Pages($book->pages),
            publishDate: new PublishDate($book->publish_date),
            quantity   : new Quantity($book->quantity),
            authors    : new Authors($authors),
            genres     : new Genres($genres)
        );
    }

    public function toArray(): array
    {
        return [
            'isbn'         => $this->isbn->isbn,
            'title'        => $this->title->title,
            'description'  => $this->description->description,
            'pages'        => $this->pages->pages,
            'publish_date' => $this->publishDate->publishDate->format('Y-m-d'),
            'quantity'     => $this->quantity->quantity,
            'authors'      => $this->authors->toArray(),
            'genres'       => $this->genres->toArray()
        ];
    }

}
