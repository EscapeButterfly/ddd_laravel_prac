<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

class Genre extends ValueObject
{
    public readonly string $genre;

    public function __construct(string $genre)
    {
        $this->genre = $genre;
    }

    public function jsonSerialize(): string
    {
        return $this->genre;
    }
}
