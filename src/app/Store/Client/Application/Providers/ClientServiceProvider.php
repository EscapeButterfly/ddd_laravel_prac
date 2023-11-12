<?php

namespace App\Store\Client\Application\Providers;

use App\Store\Client\Application\Repositories\Eloquent\ClientRepository;
use App\Store\Client\Domain\Repositories\ClientRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }
}
