<?php

namespace Innclod\Auth\Infrastructure\ServiceLayer\Providers;

use Illuminate\Support\ServiceProvider;
use Innclod\Auth\Application\Interfaces\AuthServiceInterface;
use Innclod\Auth\Application\Service\AuthService;
use Innclod\Auth\Infrastructure\Repositories\UserRepository;
use Innclod\Auth\Infrastructure\Repositories\UserRepositoryInterface;

class AuthServiceProvider extends ServiceProvider
{
    public function register():void
    {
        $this->registerRoutes();
        $this->registerBinds();
        $this->registerMiddlewares();
    }

    public function registerRoutes():void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    public function registerBinds():void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    public function registerMiddlewares():void
    {
        $router = $this->app['router'];
    }

}
