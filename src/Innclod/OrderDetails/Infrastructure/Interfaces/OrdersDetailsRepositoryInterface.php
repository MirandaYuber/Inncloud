<?php

namespace Innclod\OrderDetails\Infrastructure\Interfaces;

use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;

interface OrdersDetailsRepositoryInterface
{
    public function createOrderDetails(int $orderId, int $productId, int $quantity): int;

    public function getOrderDetailByOrderId(int $orderId): array;
}
