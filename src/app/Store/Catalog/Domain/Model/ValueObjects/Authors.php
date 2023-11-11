<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Catalog\Domain\Exception\NotValidAuthorException;
use App\Store\Catalog\Domain\Model\Entities\Author;
use App\Store\Common\Domain\ValueObjectArray;

final class Authors extends ValueObjectArray
{
    public readonly array $authors;

    public function __construct(array $authors)
    {
        parent::__construct($authors);

        foreach ($authors as $author) {
            if (!$author instanceof Author) {
                throw new NotValidAuthorException;
            }
        }

        $this->authors = $authors;
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
