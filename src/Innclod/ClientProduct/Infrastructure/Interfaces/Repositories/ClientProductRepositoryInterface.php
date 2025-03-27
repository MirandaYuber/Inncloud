<?php

namespace ClientProduct\Infrastructure\Interfaces\Repositories;

interface ClientProductRepositoryInterface
{
    public function deletedClientProductByClient(int $clientId): void;

    public function createClientProduct(int $product, int $clientId): bool;

    public function getProductIdByClientId(int $clientId): array;

}
