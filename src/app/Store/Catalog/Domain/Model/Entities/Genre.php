<?php


namespace App\Store\Catalog\Domain\Model\Entities;

use App\Store\Catalog\Domain\Model\ValueObjects\Genre as GenreValueObject;
use App\Store\Common\Domain\Entity;

class Genre extends Entity
{
    public function __construct(
        public readonly ?string          $uuid,
        public readonly GenreValueObject $genre
    )
    {
    }

    public function toArray(): array
    {
        return [
            'uuid'  => $this->uuid,
            'genre' => $this->genre
        ];
    }
}
