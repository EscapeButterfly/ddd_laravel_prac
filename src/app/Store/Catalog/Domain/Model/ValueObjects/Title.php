<?php


namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Title extends ValueObject
{
    public readonly string $value;

    public function __construct(string $title)
    {
        $this->value = $title;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
