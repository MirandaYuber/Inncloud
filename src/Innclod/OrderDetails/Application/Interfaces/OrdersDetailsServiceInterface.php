<?php

namespace Innclod\OrderDetails\Application\Interfaces;

use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;

interface OrdersDetailsServiceInterface
{
    public function createOrderDetails(RequestCreateOrderDto $createOrderDto);

    public function validateStockProduct(int $productId, $quantity): int;

    public function getOrderDetailByOrderId(int $orderId): array;
}
