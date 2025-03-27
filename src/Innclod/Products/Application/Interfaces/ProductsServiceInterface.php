<?php

namespace Innclod\Products\Application\Interfaces;

use Innclod\Products\Domain\Dto\RequestCreateProductDto;
use Innclod\Products\Domain\Dto\RequestUpdateProductDto;

interface ProductsServiceInterface
{
    public function getAllProducts(): array;

    public function getProductsByClientId(int $clientId): array;
    public function getProductsIdByClientId(int $clientId): array;

    public function getProductsByName(string $productName): array;

    public function createProduct(RequestCreateProductDto $requestCreateProductDto);

    public function updateProduct(RequestUpdateProductDto $requestUpdateProductDto);

    public function deleteProduct(int $productId);

    public function getProductStockAvailableById(int $productId);

    public function updateStockProduct(int $productId, int $quantity);

}
