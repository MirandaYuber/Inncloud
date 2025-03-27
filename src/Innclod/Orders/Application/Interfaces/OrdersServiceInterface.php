<?php

namespace Innclod\Orders\Application\Interfaces;

use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;

interface OrdersServiceInterface
{
    public function createOrder(RequestCreateOrderDto $createOrderDto);

    public function getAllOrders(): array;

    public function getOrdesByClientId(int $clientId): array;

}
