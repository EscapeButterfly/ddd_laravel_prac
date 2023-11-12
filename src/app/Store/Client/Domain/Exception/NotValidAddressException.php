<?php

namespace App\Store\Client\Domain\Exception;

use Throwable;

class NotValidAddressException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Given address is not valid Address Entity.');
    }
}
