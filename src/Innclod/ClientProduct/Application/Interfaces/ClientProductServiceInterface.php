<?php

namespace ClientProduct\Application\Interfaces;

interface ClientProductServiceInterface
{
    public function synchronizeClientProduct(array $products, int $clientId): int;

    public function getProductIdByClientId(int $clientId): array;
}
