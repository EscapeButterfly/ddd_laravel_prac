<?php

namespace App\Store\Auth\Application;

use App\Store\Auth\Domain\AuthInterface;
use App\Store\Client\Application\Mappers\ClientMapper;
use App\Store\Client\Domain\Model\Client;
use App\Store\Client\Infrastructure\EloquentModels\Client as ClientEloquent;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

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
            throw new AuthenticationException('Given wrong credentials.');
        }
        return $token;
    }

    /**
     * @return string
     * @throws AuthenticationException
     */
    public function refresh(): string
    {
        try {
            $token = auth('clients')->refresh();
        } catch (JWTException $exception) {
            throw new AuthenticationException($exception->getMessage());
        }
        return $token;
    }

    public function logout(): void
    {
        auth('clients')->logout();
    }

    /**
     * @return Client
     * @throws AuthenticationException
     */
    public function me(): Client
    {
        $client = auth('clients')->user();
        if ($client) {
            return ClientMapper::fromEloquent($client);
        } else {
            throw new AuthenticationException('Unauthenticated.');
        }
    }
}
