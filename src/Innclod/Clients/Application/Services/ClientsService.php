<?php

namespace Clients\Application\Services;

use ClientProduct\Application\Interfaces\ClientProductServiceInterface;
use ClientProduct\Infrastructure\Interfaces\Repositories\ClientProductRepositoryInterface;
use Clients\Application\Interfaces\Services\ClientsServiceInterface;
use Clients\Domain\Dto\RequestCreateClientDto;
use Clients\Domain\Dto\RequestGetClientDto;
use Clients\Domain\Dto\RequestUpdateClientDto;
use Clients\Infrastructure\Interfaces\Repositories\ClientsRepositoryInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ClientsService implements ClientsServiceInterface
{
    protected ClientsRepositoryInterface $clientsRepository;
    protected ClientProductServiceInterface $clientProductService;

    public function __construct()
    {
        $this->clientsRepository = App::make(ClientsRepositoryInterface::class);
        $this->clientProductService = App::make(ClientProductServiceInterface::class);
    }

    public function getClientsByFilter(RequestGetClientDto $requestGetClientDto)
    {
        if ($requestGetClientDto->typeFilter === 'name') {
            $clients = $this->clientsRepository
                ->getClientByName($requestGetClientDto->dataClient);
        } else {
            $clients = $this->clientsRepository
                ->getClientByEmail($requestGetClientDto->dataClient);
        }

        return $clients;
    }

    public function getClientsAll()
    {
        return $this->clientsRepository
            ->getClientAll();
    }

    public function createClient(RequestCreateClientDto $requestCreateClientDto)
    {
        $products = $requestCreateClientDto->products;
        $clientId = $this->clientsRepository->createClient($requestCreateClientDto);

        return $this->clientProductService->synchronizeClientProduct($products, $clientId);
    }

    public function updateClient(RequestUpdateClientDto $requestUpdateClientDto)
    {
        $clientId = $requestUpdateClientDto->id;
        $products = $requestUpdateClientDto->products;
        $this->clientsRepository->updateClient($requestUpdateClientDto);

        return $this->clientProductService->synchronizeClientProduct($products, $clientId);
    }

    public function deleteClient(int $clientId)
    {
        return $this->clientsRepository->deleteClient($clientId);
    }
}
