<?php

namespace App\Store\Auth\Domain;

use App\Store\Client\Domain\Model\Client;
use Illuminate\Auth\AuthenticationException;

interface AuthInterface
{
    /**
     * @param array $credentials
     * @throws AuthenticationException
     * @return string
     */
    public function login(array $credentials): string;

    public function refresh(): string;

    public function logout(): void;

    public function me(): Client;
}
