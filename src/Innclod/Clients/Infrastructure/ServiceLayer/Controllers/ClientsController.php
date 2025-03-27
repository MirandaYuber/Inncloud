<?php

namespace Clients\Infrastructure\ServiceLayer\Controllers;

use Clients\Application\Interfaces\Services\ClientsServiceInterface;
use Clients\Application\Mappers\RequestCreateClientDtoMapper;
use Clients\Application\Mappers\RequestGetClientDtoMapper;
use Clients\Application\Mappers\RequestUpdateClientDtoMapper;
use Clients\Domain\Dto\RequestUpdateClientDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Innclod\Products\Application\Interfaces\ProductsServiceInterface;
use Yuber\Http\Infrastructure\ServiceLayer\Controllers\BaseController;

class ClientsController extends BaseController
{
    protected ClientsServiceInterface $clientsService;
    protected ProductsServiceInterface $productsService;

    public function __construct()
    {
        $this->initializeDependencies();
    }

    protected function initializeDependencies(): void
    {
        $this->clientsService = App::make(ClientsServiceInterface::class);
        $this->productsService = App::make(ProductsServiceInterface::class);
    }

    public function index()
    {
        $clients = $this->clientsService
            ->getClientsAll();

        $products = $this->productsService
            ->getAllProducts();

        return view('clients.index', [
            'clients' => $clients,
            'products' => $products
        ]);
    }

    public function getClientsByFilter(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(false);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'typeFilter' => 'required|string',
                'dataClient' => 'required|string',
            ]);

            $requestGetClientDto = (new RequestGetClientDtoMapper())
                ->createFromRequest($request);

            $clients = $this->clientsService
                ->getClientsByFilter($requestGetClientDto);


            return [
                'success' => true,
                'message' => 'Proceso exitoso',
                'clients' => $clients,
            ];
        });
    }

    public function createClient(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(true, ['pgsql']);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'products' => 'required|array',
            ]);

            $requestCreateClientDto = (new RequestCreateClientDtoMapper())
                ->createFromRequest($request);

            $insertionCount = $this->clientsService->createClient($requestCreateClientDto);

            return [
                'success' => true,
                'message' => 'Cliente creado exitosamente',
                'insertionCount' => $insertionCount
            ];
        });
    }

    public function updateClient(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(true, ['pgsql']);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'id' => 'required|int|exists:clients,id',
                'name' => 'required|string',
                'email' => 'required|string',
                'products' => 'required|array',
            ]);

            $requestUpdateClientDto = (new RequestUpdateClientDtoMapper())
                ->createFromRequest($request);

            $insertionCount = $this->clientsService->updateClient($requestUpdateClientDto);

            return [
                'success' => true,
                'message' => 'Cliente actualizado exitosamente',
                'insertionCount' => $insertionCount
            ];
        });
    }

    public function deleteClient(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(true, ['pgsql']);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'idClient' => 'required|int|exists:clients,id',
            ]);
            $clientId = $request->input('idClient');

            $this->clientsService->deleteClient($clientId);

            return [
                'success' => true,
                'message' => 'Cliente eliminado exitosamente',
            ];
        });
    }
}
