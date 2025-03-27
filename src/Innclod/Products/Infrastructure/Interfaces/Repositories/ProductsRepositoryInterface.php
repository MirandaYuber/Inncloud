<?php

namespace Innclod\Products\Infrastructure\Interfaces\Repositories;

use Innclod\Products\Domain\Dto\RequestCreateProductDto;
use Innclod\Products\Domain\Dto\RequestUpdateProductDto;

interface ProductsRepositoryInterface
{
    public function getAllProducts(): array;

    public function getProductsById(array $productsId): array;

    public function getProductsByName(string $productName): array;

    public function createProduct(RequestCreateProductDto $requestCreateProductDto): bool;

    public function updateProduct(RequestUpdateProductDto $requestUpdateProductDto): bool;

    public function deleteProduct(int $productId): bool;

    public function getProductStockAvailableById(int $productId): int;

    public function updateStockProduct(int $productId, int $newStock): int;

}
