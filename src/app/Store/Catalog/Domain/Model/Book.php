<?php


namespace App\Store\Catalog\Domain\Model;

use App\Store\Catalog\Domain\Model\ValueObjects\Authors;
use App\Store\Catalog\Domain\Model\ValueObjects\Description;
use App\Store\Catalog\Domain\Model\ValueObjects\Genres;
use App\Store\Catalog\Domain\Model\ValueObjects\Isbn;
use App\Store\Catalog\Domain\Model\ValueObjects\Pages;
use App\Store\Catalog\Domain\Model\ValueObjects\Prices;
use App\Store\Catalog\Domain\Model\ValueObjects\PublishDate;
use App\Store\Catalog\Domain\Model\ValueObjects\Quantity;
use App\Store\Catalog\Domain\Model\ValueObjects\Title;
use App\Store\Common\Domain\AggregateRoot;


class Book extends AggregateRoot
{
    public function __construct(
        public readonly ?string     $uuid,
        public readonly Title       $title,
        public readonly Isbn        $isbn,
        public readonly Description $description,
        public readonly Pages       $pages,
        public readonly PublishDate $publishDate,
        public readonly Genres      $genres,
        public readonly Authors     $authors,
        public readonly Quantity    $quantity,
        public readonly Prices      $prices
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'         => $this->uuid,
            'title'        => $this->title,
            'isbn'         => $this->isbn,
            'description'  => $this->description,
            'pages'        => $this->pages,
            'publish_date' => $this->publishDate,
            'genres'       => $this->genres,
            'authors'      => $this->authors,
            'quantity'     => $this->quantity,
            'prices'       => $this->prices
        ];
    }
}
