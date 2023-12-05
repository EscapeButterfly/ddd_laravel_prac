<?php

namespace App\Store\Auth\Application\Providers;

use App\Store\Auth\Application\JWTAuth;
use App\Store\Auth\Domain\AuthInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }

    public function register(): void
    {
        $this->app->bind(AuthInterface::class, JWTAuth::class);
    }
}
