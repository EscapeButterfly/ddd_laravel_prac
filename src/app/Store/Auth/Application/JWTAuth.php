<?php

namespace App\Store\Auth\Application;

use App\Store\Auth\Domain\AuthInterface;
use App\Store\Client\Application\Mappers\ClientMapper;
use App\Store\Client\Domain\Model\Client;
use App\Store\Client\Infrastructure\EloquentModels\Client as ClientEloquent;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class JWTAuth implements AuthInterface
{
    /**
     * @param array $credentials
     * @return string
     * @throws AuthenticationException|ModelNotFoundException
     */
    public function login(array $credentials): string
    {
        ClientEloquent::query()
            ->where('email', $credentials['email'])
            ->firstOrFail();
        if (!$token = auth('clients')->attempt($credentials)) {
            throw new AuthenticationException();
        }
        return $token;
    }

    public function refresh(): string
    {
        return \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::refresh();
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function me(): Client
    {
        return ClientMapper::fromEloquent(auth('clients')->user());
    }
}
