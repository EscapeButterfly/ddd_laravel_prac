<?php

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Catalog\Domain\Exception\NotValidAuthorException;
use App\Store\Catalog\Domain\Model\Entities\Author;
use App\Store\Common\Domain\ValueObjectArray;

final class Authors extends ValueObjectArray
{
    public readonly array $value;

    public function __construct(array $authors)
    {
        parent::__construct($authors);

        foreach ($authors as $author) {
            if (!$author instanceof Author) {
                throw new NotValidAuthorException;
            }
        }

        $this->value = $authors;
    }

    public function toArray(): array
    {
        return $this->value;
    }

    public function jsonSerialize(): array
    {
        return $this->value;
    }
}
