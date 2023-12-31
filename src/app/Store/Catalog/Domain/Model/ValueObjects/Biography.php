<?php


namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Biography extends ValueObject
{
    public readonly string $value;

    public function __construct(string $biography)
    {
        $this->value = $biography;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
