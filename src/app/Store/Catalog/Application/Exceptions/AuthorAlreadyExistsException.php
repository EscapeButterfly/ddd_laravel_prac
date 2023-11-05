<?php

namespace App\Store\Catalog\Application\Exceptions;

class AuthorAlreadyExistsException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Author with given name already exists');
    }
}
