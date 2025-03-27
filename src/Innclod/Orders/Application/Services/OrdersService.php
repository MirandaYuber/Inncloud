<?php

namespace Innclod\Orders\Application\Services;

use Illuminate\Support\Facades\App;
use Innclod\OrderDetails\Application\Interfaces\OrdersDetailsServiceInterface;
use Innclod\Orders\Application\Interfaces\OrdersServiceInterface;
use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;
use Innclod\Orders\Infrastructure\Interfaces\OrdersRepositoryInterface;

class OrdersService implements OrdersServiceInterface
{
    protected OrdersRepositoryInterface $ordersRepository;
    protected OrdersDetailsServiceInterface $ordersDetailsService;

    public function __construct()
    {
        $this->ordersRepository = App::make(OrdersRepositoryInterface::class);
        $this->ordersDetailsService = App::make(OrdersDetailsServiceInterface::class);
    }

    public function createOrder(RequestCreateOrderDto $createOrderDto)
    {
        $clientId = $createOrderDto->clientId;
        $createOrderDto->orderId = $this->ordersRepository->createOrder($clientId);

        return $this->ordersDetailsService->createOrderDetails($createOrderDto);
    }

    public function getAllOrders(): array
    {
        return $this->ordersRepository->getAllOrders();
    }

    public function getOrdesByClientId(int $clientId): array
    {
        return $this->ordersRepository->getOrdesByClientId($clientId);
    }

}
