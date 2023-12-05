<?php


namespace App\Store\Catalog\Domain\Model\ValueObjects;

use DateTimeImmutable;
use App\Store\Common\Domain\ValueObject;

final class BirthDate extends ValueObject
{
    public readonly DateTimeImmutable $value;

    public function __construct(DateTimeImmutable $birthDate)
    {
        $this->value = $birthDate;
    }

    public function jsonSerialize(): string
    {
        return $this->value->format('Y-m-d');
    }
}
