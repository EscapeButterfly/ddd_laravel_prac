<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObjectArray;

final class Authors extends ValueObjectArray
{
    public readonly array $authors;

    public function __construct(array $authors)
    {
        parent::__construct($authors);

        $this->authors = $authors;
    }

    public function __toString(): string
    {
        return implode(', ', $this->authors);
    }

    public function toArray(): array
    {
        return $this->authors;
    }

    public function jsonSerialize(): array
    {
        return $this->authors;
    }
}
