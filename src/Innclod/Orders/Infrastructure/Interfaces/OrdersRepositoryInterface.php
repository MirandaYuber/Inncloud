<?php

namespace Innclod\Orders\Infrastructure\Interfaces;

use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;

interface OrdersRepositoryInterface
{
    public function createOrder(int $clientId): int;

    public function getAllOrders(): array;

    public function getOrdesByClientId(int $clientId): array;
}
