<?php

namespace Innclod\Products\Application\Services;

use ClientProduct\Application\Interfaces\ClientProductServiceInterface;
use Illuminate\Support\Facades\App;
use Innclod\Products\Application\Interfaces\ProductsServiceInterface;
use Innclod\Products\Domain\Dto\RequestCreateProductDto;
use Innclod\Products\Domain\Dto\RequestUpdateProductDto;
use Innclod\Products\Infrastructure\Interfaces\Repositories\ProductsRepositoryInterface;

class ProductsService implements ProductsServiceInterface
{
    protected ProductsRepositoryInterface $productsRepository;
    protected ClientProductServiceInterface $clientProductService;

    public function __construct()
    {
        $this->productsRepository = App::make(ProductsRepositoryInterface::class);
        $this->clientProductService = App::make(ClientProductServiceInterface::class);
    }

    public function getAllProducts(): array
    {
        return $this->productsRepository->getAllProducts();
    }

    public function getProductsByClientId(int $clientId): array
    {
        $products = $this->clientProductService->getProductIdByClientId($clientId);
        $productsId = array_map(function ($product) {
            return $product->product_id;
        }, $products);

        return $this->productsRepository->getProductsById($productsId);
    }

    public function getProductsIdByClientId(int $clientId): array
    {
        $products = $this->clientProductService->getProductIdByClientId($clientId);

        return array_map(function ($product) {
            return $product->product_id;
        }, $products);
    }

    public function getProductsByName(string $productName): array
    {
        return $this->productsRepository->getProductsByName($productName);
    }

    public function createProduct(RequestCreateProductDto $requestCreateProductDto)
    {
        return $this->productsRepository->createProduct($requestCreateProductDto);
    }

    public function updateProduct(RequestUpdateProductDto $requestUpdateProductDto)
    {
        return $this->productsRepository->updateProduct($requestUpdateProductDto);
    }

    public function deleteProduct(int $productId)
    {
        return $this->productsRepository->deleteProduct($productId);
    }

    public function getProductStockAvailableById(int $productId)
    {
        return $this->productsRepository->getProductStockAvailableById($productId);
    }

    public function updateStockProduct(int $productId, int $quantity)
    {
        return $this->productsRepository->updateStockProduct($productId, $quantity);
    }

}
