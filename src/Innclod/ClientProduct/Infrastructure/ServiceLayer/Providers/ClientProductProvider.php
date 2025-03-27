<?php

namespace Innclod\ClientProduct\Infrastructure\ServiceLayer\Providers;

use Carbon\Laravel\ServiceProvider;
use ClientProduct\Application\Interfaces\ClientProductServiceInterface;
use ClientProduct\Application\Services\ClientProductService;
use ClientProduct\Infrastructure\Interfaces\Repositories\ClientProductRepositoryInterface;
use ClientProduct\Infrastructure\Repositories\ClientProductRepository;

class ClientProductProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'clients');
    }


    public function registerBinds(): void
    {
        $this->app->bind(ClientProductServiceInterface::class, ClientProductService::class);
        $this->app->bind(ClientProductRepositoryInterface::class, ClientProductRepository::class);
    }

    public function registerMiddlewares(): void
    {
        $router = $this->app['router'];
    }

    public function boot()
    {

    }
}
