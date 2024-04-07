<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    ProductRepositoryInterface,
    ProductImportHistoryRepositoryInterface
};
use App\Repositories\{
    ProductRepository,
    ProductImportHistoryRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );

        $this->app->bind(
            ProductImportHistoryRepositoryInterface::class,
            ProductImportHistoryRepository::class,
        );
    }

    public function boot(): void
    {

    }
}
