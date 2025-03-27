<?php

namespace Innclod\Orders\Infrastructure\ServiceLayer\Providers;

use Carbon\Laravel\ServiceProvider;
use Innclod\Orders\Application\Interfaces\OrdersServiceInterface;
use Innclod\Orders\Application\Services\OrdersService;
use Innclod\Orders\Infrastructure\Interfaces\OrdersRepositoryInterface;
use Innclod\Orders\Infrastructure\Repositories\OrdersRepository;

class OrdersProvider extends ServiceProvider
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
        $this->app->bind(OrdersRepositoryInterface::class, OrdersRepository::class);
        $this->app->bind(OrdersServiceInterface::class, OrdersService::class);
    }

    public function registerMiddlewares(): void
    {
        $router = $this->app['router'];
    }

    public function boot()
    {

    }
}
