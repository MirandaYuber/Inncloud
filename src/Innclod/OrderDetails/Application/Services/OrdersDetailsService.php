<?php

namespace Innclod\OrderDetails\Application\Services;

use Illuminate\Support\Facades\App;
use Innclod\OrderDetails\Application\Interfaces\OrdersDetailsServiceInterface;
use Innclod\OrderDetails\Domain\Exceptions\InsufficientStockException;
use Innclod\OrderDetails\Infrastructure\Interfaces\OrdersDetailsRepositoryInterface;
use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;
use Innclod\Products\Application\Interfaces\ProductsServiceInterface;

class OrdersDetailsService implements OrdersDetailsServiceInterface
{
    protected OrdersDetailsRepositoryInterface $ordersDetailsRepository;
    protected ProductsServiceInterface $productsService;

    public function __construct()
    {
        $this->ordersDetailsRepository = App::make(OrdersDetailsRepositoryInterface::class);
        $this->productsService = App::make(ProductsServiceInterface::class);
    }

    /**
     * @throws InsufficientStockException
     */
    public function createOrderDetails(RequestCreateOrderDto $createOrderDto)
    {
        $listProducts = $createOrderDto->listProducts;
        $orderId = $createOrderDto->orderId;
        $insertionCount = 0;

        foreach ($listProducts as $produc) {
            $productId = $produc['id'];
            $quantity = $produc['quantity'];
            $newStock = $this->validateStockProduct($productId, $quantity);

            $insertionCount += $this->ordersDetailsRepository->createOrderDetails(
                $orderId, $productId, $quantity
            );

            $this->productsService->updateStockProduct($productId, $newStock);
        }

        return $insertionCount;
    }

    /**
     * @throws InsufficientStockException
     */
    public function validateStockProduct(int $productId, $quantity): int
    {
        $stockAvailable = $this->productsService->getProductStockAvailableById($productId);

        if ($stockAvailable < $quantity) {
            throw new InsufficientStockException();
        }

        return $stockAvailable - $quantity;
    }

    public function getOrderDetailByOrderId(int $orderId): array
    {
        return $this->ordersDetailsRepository->getOrderDetailByOrderId($orderId);
    }

}
