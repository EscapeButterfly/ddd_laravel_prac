<?php

namespace App\Store\Order\Domain\Exceptions;

class NotValidItemException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Given item is not valid OrderItem Entity.');
    }
}
