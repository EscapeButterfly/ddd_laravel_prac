<?php

namespace App\Store\Order\Application\Providers;

use App\Store\Order\Application\Repositories\Eloquent\OrderRepository;
use App\Store\Order\Domain\Repositories\OrderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }
}
