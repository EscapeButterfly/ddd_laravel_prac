<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

class Genre extends ValueObject
{
    public readonly string $value;

    public function __construct(string $genre)
    {
        $this->value = $genre;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
