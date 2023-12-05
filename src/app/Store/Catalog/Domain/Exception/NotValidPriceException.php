<?php

namespace App\Store\Catalog\Domain\Exception;

class NotValidPriceException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Given price is not valid Price Entity.');
    }
}
