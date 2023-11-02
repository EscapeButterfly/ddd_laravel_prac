<?php

namespace App\Store\Catalog\Application\DTO;

use App\Store\Catalog\Domain\Model\ValueObjects\Description;
use App\Store\Catalog\Domain\Model\ValueObjects\Isbn;
use App\Store\Catalog\Domain\Model\ValueObjects\Pages;
use App\Store\Catalog\Domain\Model\ValueObjects\PublishDate;
use App\Store\Catalog\Domain\Model\ValueObjects\Quantity;
use App\Store\Catalog\Domain\Model\ValueObjects\Title;
use App\Store\Catalog\Infrastructure\EloquentModels\Book;
use Illuminate\Http\Request;

class BookData
{
    public function __construct(
        public readonly string      $uuid,
        public readonly Isbn        $isbn,
        public readonly Title       $title,
        public readonly Description $description,
        public readonly Pages       $pages,
        public readonly PublishDate $publishDate,
        public readonly Quantity    $quantity,
    )
    {
    }

    public static function fromRequest(Request $request, $uuid): BookData
    {
        return new self(
            uuid       : $uuid,
            isbn       : new Isbn($request->input('isbn')),
            title      : new Title($request->input('title')),
            description: new Description($request->input('description')),
            pages      : new Pages($request->input('pages')),
            publishDate: new PublishDate($request->input('publish_date')),
            quantity   : new Quantity($request->input('quantity')),
        );
    }

    public static function fromEloquent(Book $book): BookData
    {
        return new self(
            uuid       : $book->uuid,
            isbn       : new Isbn($book->isbn),
            title      : new Title($book->title),
            description: new Description($book->description),
            pages      : new Pages($book->pages),
            publishDate: new PublishDate($book->publish_date),
            quantity   : new Quantity($book->quantity),
        );
    }

    public function toArray(): array
    {
        return [
            'uuid'        => $this->uuid,
            'isbn'        => $this->isbn,
            'title'       => $this->title,
            'description' => $this->description,
            'pages'       => $this->pages,
            'publishDate' => $this->publishDate,
            'quantity'    => $this->quantity
        ];
    }

}
