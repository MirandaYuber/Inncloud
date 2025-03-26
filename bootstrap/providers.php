<?php

return [
    App\Providers\AppServiceProvider::class,
    Innclod\Products\Infrastructure\ServiceLayer\Providers\ProductsProvider::class,
    Innclod\Clients\Infrastructure\ServiceLayer\Providers\ClientsProvider::class,
    Innclod\ClientProduct\Infrastructure\ServiceLayer\Providers\ClientProductProvider::class,
    Innclod\Orders\Infrastructure\ServiceLayer\Providers\OrdersProvider::class,
    Innclod\OrderDetails\Infrastructure\ServiceLayer\Providers\OrdersDetailsProvider::class,
    Innclod\Auth\Infrastructure\ServiceLayer\Providers\AuthServiceProvider::class
];
