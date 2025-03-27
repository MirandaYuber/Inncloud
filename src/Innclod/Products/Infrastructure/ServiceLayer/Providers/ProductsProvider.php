<?php

namespace Innclod\Products\Infrastructure\ServiceLayer\Providers;

use Carbon\Laravel\ServiceProvider;
use Innclod\Products\Application\Interfaces\ProductsServiceInterface;
use Innclod\Products\Application\Services\ProductsService;
use Innclod\Products\Infrastructure\Interfaces\Repositories\ProductsRepositoryInterface;
use Innclod\Products\Infrastructure\Repositories\ProductsRepository;

class ProductsProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerRoutes();
        $this->registerBinds();
        $this->registerMiddlewares();
    }


    public function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }


    public function registerBinds(): void
    {
        $this->app->bind(ProductsServiceInterface::class, ProductsService::class);
        $this->app->bind(ProductsRepositoryInterface::class, ProductsRepository::class);
    }

    public function registerMiddlewares(): void
    {
        $router = $this->app['router'];
    }

    public function boot()
    {

    }
}
