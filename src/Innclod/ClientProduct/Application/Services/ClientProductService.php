<?php

namespace ClientProduct\Application\Services;

use ClientProduct\Application\Interfaces\ClientProductServiceInterface;
use ClientProduct\Infrastructure\Interfaces\Repositories\ClientProductRepositoryInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ClientProductService implements ClientProductServiceInterface
{
    protected ClientProductRepositoryInterface $clientProductRepository;

    public function __construct()
    {
        $this->clientProductRepository = App::make(ClientProductRepositoryInterface::class);
    }
    public function synchronizeClientProduct(array $products, int $clientId): int
    {
        $insertionCount = 0;
        $this->clientProductRepository->deletedClientProductByClient($clientId);

        foreach ($products as $product) {
            $insertionCount += $this->clientProductRepository->createClientProduct($product, $clientId);
        }

        return $insertionCount;
    }

    public function getProductIdByClientId(int $clientId): array
    {
        return $this->clientProductRepository->getProductIdByClientId($clientId);
    }

}
