<?php

namespace Innclod\OrderDetails\Infrastructure\ServiceLayer\Providers;

use Carbon\Laravel\ServiceProvider;
use Innclod\OrderDetails\Application\Interfaces\OrdersDetailsServiceInterface;
use Innclod\OrderDetails\Application\Services\OrdersDetailsService;
use Innclod\OrderDetails\Infrastructure\Interfaces\OrdersDetailsRepositoryInterface;
use Innclod\OrderDetails\Infrastructure\Repositories\OrdersDetailsRepository;
use Innclod\Orders\Application\Interfaces\OrdersServiceInterface;
use Innclod\Orders\Application\Services\OrdersService;
use Innclod\Orders\Infrastructure\Interfaces\OrdersRepositoryInterface;
use Innclod\Orders\Infrastructure\Repositories\OrdersRepository;

class OrdersDetailsProvider extends ServiceProvider
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
        $this->app->bind(OrdersDetailsRepositoryInterface::class, OrdersDetailsRepository::class);
        $this->app->bind(OrdersDetailsServiceInterface::class, OrdersDetailsService::class);
    }

    public function registerMiddlewares(): void
    {
        $router = $this->app['router'];
    }

    public function boot()
    {

    }
}
