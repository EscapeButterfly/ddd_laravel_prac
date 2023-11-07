<?php

namespace App\Store\Catalog\Application\Providers;

use App\Store\Catalog\Application\Repositories\Eloquent\AuthorRepository;
use App\Store\Catalog\Application\Repositories\Eloquent\BookRepository;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }
}
