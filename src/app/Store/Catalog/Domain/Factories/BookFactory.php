<?php

namespace App\Store\Catalog\Domain\Factories;

use App\Store\Catalog\Domain\Model\Book;
use App\Store\Catalog\Domain\Model\ValueObjects\Description;
use App\Store\Catalog\Domain\Model\ValueObjects\Genres;
use App\Store\Catalog\Domain\Model\ValueObjects\Isbn;
use App\Store\Catalog\Domain\Model\ValueObjects\Pages;
use App\Store\Catalog\Domain\Model\ValueObjects\PublishDate;
use App\Store\Catalog\Domain\Model\ValueObjects\Quantity;
use App\Store\Catalog\Domain\Model\ValueObjects\Title;
use Illuminate\Support\Carbon;

class BookFactory
{
    public static function new(array $attributes = null): Book
    {
        if (!$attributes) {
            $genres = [];
            for ($i = 0; $i < 3; $i++) {
                $genres[] = GenreFactory::new();
            }
            $publishDateCarbon = Carbon::createFromTimestamp(fake()->dateTimeBetween('-180 years', 'now')->getTimestamp());
            $defaults = [
                'uuid'         => fake()->uuid,
                'title'        => fake()->jobTitle,
                'isbn'         => fake()->isbn13(),
                'description'  => fake()->text(300),
                'pages'        => rand(100, 2000),
                'publish_date' => $publishDateCarbon->toDateTimeImmutable(),
                'genres'       => $genres,
                'quantity'     => rand(1, 100)
            ];
            return new Book(
                uuid       : $defaults['uuid'],
                title      : new Title($defaults['title']),
                isbn       : new Isbn($defaults['isbn']),
                description: new Description($defaults['description']),
                pages      : new Pages($defaults['pages']),
                publishDate: new PublishDate($defaults['publish_date']),
                genres     : new Genres($defaults['genres']),
                author     : AuthorFactory::new(),
                quantity   : new Quantity($defaults['quantity'])
            );
        } else {
            return new Book(
                uuid       : $attributes['uuid'],
                title      : new Title($attributes['title']),
                isbn       : new Isbn($attributes['isbn']),
                description: new Description($attributes['description']),
                pages      : new Pages($attributes['pages']),
                publishDate: new PublishDate($attributes['publish_date']),
                genres     : new Genres($attributes['genres']),
                author     : $attributes['author'],
                quantity   : new Quantity($attributes['quantity'])
            );
        }
    }
}
