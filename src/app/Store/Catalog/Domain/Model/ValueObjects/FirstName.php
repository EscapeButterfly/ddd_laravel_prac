<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class FirstName extends ValueObject
{
    public readonly string $firstName;

    public function __construct(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function jsonSerialize(): string
    {
        return $this->firstName;
    }
}
