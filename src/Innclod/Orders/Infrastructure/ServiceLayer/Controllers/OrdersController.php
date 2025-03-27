<?php

namespace Innclod\Orders\Infrastructure\ServiceLayer\Controllers;

use Clients\Application\Interfaces\Services\ClientsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Innclod\OrderDetails\Application\Interfaces\OrdersDetailsServiceInterface;
use Innclod\Orders\Application\Interfaces\OrdersServiceInterface;
use Innclod\Orders\Application\Mappers\RequestCreateOrderDtoMapper;
use Yuber\Http\Infrastructure\ServiceLayer\Controllers\BaseController;

class OrdersController extends BaseController
{
    protected OrdersServiceInterface $ordersService;
    protected OrdersDetailsServiceInterface $ordersDetailsService;

    protected ClientsServiceInterface $clientsService;

    public function __construct()
    {
        $this->initializeDependencies();
    }

    public function initializeDependencies(): void
    {
        $this->ordersService = App::make(OrdersServiceInterface::class);
        $this->ordersDetailsService = App::make(OrdersDetailsServiceInterface::class);
        $this->clientsService = App::make(ClientsServiceInterface::class);
    }

    public function index() {
        $orders = $this->ordersService->getAllOrders();
        $clients = $this->clientsService->getClientsAll();

        return view('orders.index', [
            'orders' => $orders,
            'clients' => $clients
        ]);
    }

    public function createOrder(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(true, ['pgsql']);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'clientId' => 'required|int|exists:clients,id',
                'listProducts' => 'required|array',
                'listProducts.*.id' => 'exists:products,id',
            ]);

            $requestCreateOrderDto = (new RequestCreateOrderDtoMapper())
                ->createFromRequest($request);

            $insertionCount = $this->ordersService->createOrder($requestCreateOrderDto);

            return [
                'success' => true,
                'message' => "Orden creada exitosamente",
                'insertionCount' => $insertionCount,
            ];
        });
    }

    public function getOrdersByClientId(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(false);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'clientId' => 'required|int|exists:clients,id',
            ]);

            $clientId = $request->get('clientId');
            $orders = $this->ordersService->getOrdesByClientId($clientId);

            return [
                'success' => true,
                'message' => "Proceso exitoso",
                'orders' => $orders
            ];
        });
    }

    public function getOrderDetailByOrderId(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(false);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'orderId' => 'required|int|exists:orders,id',
            ]);

            $orderId = $request->get('orderId');
            $orderDetail = $this->ordersDetailsService->getOrderDetailByOrderId($orderId);

            return [
                'success' => true,
                'message' => "Proceso exitoso",
                'orderDetail' => $orderDetail
            ];
        });
    }

}
