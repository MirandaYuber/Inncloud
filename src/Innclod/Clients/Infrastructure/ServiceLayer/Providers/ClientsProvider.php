<?php

namespace Innclod\Clients\Infrastructure\ServiceLayer\Providers;

//Uses
use Clients\Application\Interfaces\Services\ClientsServiceInterface;
use Clients\Application\Services\ClientsService;
use Clients\Infrastructure\Interfaces\Repositories\ClientsRepositoryInterface;
use Clients\Infrastructure\Repositories\ClientsRepository;
use Illuminate\Support\ServiceProvider;


class ClientsProvider extends ServiceProvider
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
        $this->app->bind(ClientsServiceInterface::class, ClientsService::class);
        $this->app->bind(ClientsRepositoryInterface::class, ClientsRepository::class);
//        $this->app->bind(NewsUsersRepositoryInterface::class, NewsUsersRepository::class);
//        $this->app->bind(AreasRepositoryInterface::class, AreasRepository::class);
//        $this->app->bind(NewsServiceInterface::class, NewsService::class);
//        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
//        $this->app->bind(NewsCategoriesRepositoryInterface::class, NewsCategoriesRepository::class);
//        $this->app->bind(AreasServiceInterface::class, AreasService::class);
    }

    public function registerMiddlewares(): void
    {
        $router = $this->app['router'];
    }

    public function boot()
    {

    }

}
