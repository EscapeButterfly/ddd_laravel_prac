<?php


namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Isbn extends ValueObject
{
    public readonly string $value;

    public function __construct(string $isbn)
    {
        $this->value = $isbn;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
