<?php

namespace App\Store\Catalog\Application\DTO;

use App\Store\Catalog\Domain\Model\ValueObjects\Genre;
use App\Store\Catalog\Infrastructure\EloquentModels\Genre as GenreEloquent;
use Illuminate\Http\Request;

class GenreData
{

    public function __construct(
        public readonly string $uuid,
        public readonly Genre  $genre
    )
    {
    }

    public static function fromRequest(Request $request, string $uuid): GenreData
    {
        return new self(
            uuid : $uuid,
            genre: new Genre($request->input('genre'))
        );
    }

    public static function fromEloquent(GenreEloquent $genre): GenreData
    {
        return new self(
            uuid : $genre->uuid,
            genre: new Genre($genre->genre)
        );
    }

    public function toArray(): array
    {
        return [
            'uuid'  => $this->uuid,
            'genre' => $this->genre
        ];
    }
}
