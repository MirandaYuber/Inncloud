<?php

namespace Innclod\Products\Infrastructure\ServiceLayer\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Innclod\Products\Application\Interfaces\ProductsServiceInterface;
use Innclod\Products\Application\Mappers\RequestCreateProductDtoMapper;
use Innclod\Products\Application\Mappers\RequestUpdateProductDtoMapper;
use Yuber\Http\Infrastructure\ServiceLayer\Controllers\BaseController;

class ProductsController extends BaseController
{
    protected ProductsServiceInterface $productsService;
    public function __construct()
    {
        $this->initializeDependencies();
    }

    protected function initializeDependencies(): void
    {
        $this->productsService = App::make(ProductsServiceInterface::class);
    }

    public function index()
    {
        $products = $this->productsService->getAllProducts();

        return view('products.index', [
            'products' => $products
        ]);
    }

    public function getProductsByClientId(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(false);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'clientId' => 'required|int|exists:clients,id'
            ]);

            $products = $this->productsService->getProductsByClientId($request->get('clientId'));

            return [
                'success' => true,
                'message' => "Proceso exitoso",
                'products' => $products
            ];
        });
    }

    public function getProductsIdByClientId(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(false);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'clientId' => 'required|int|exists:clients,id'
            ]);

            $productsId = $this->productsService->getProductsIdByClientId($request->get('clientId'));

            return [
                'success' => true,
                'message' => "Proceso exitoso",
                'productsId' => $productsId
            ];
        });
    }

    public function getProductsByName(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(false);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'name' => 'required|string'
            ]);

            $name = $request->get('name');
            $products = $this->productsService->getProductsByName($name);

            return [
                'success' => true,
                'message' => "Proceso exitoso",
                'products' => $products
            ];
        });
    }

    public function createProduct(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(true, ['pgsql']);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'name' => 'required|string',
                'stock' => 'required|int'
            ]);

            $requestCreateProductDto = (new RequestCreateProductDtoMapper())
                ->createFromRequest($request);

            $this->productsService->createProduct($requestCreateProductDto);

            return [
                'success' => true,
                'message' => "Se creo el producto exitosamente",
            ];
        });
    }

    public function updateProduct(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(true, ['pgsql']);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'productId' => 'required|int|exists:products,id',
                'name' => 'required|string',
                'stock' => 'required|int',
            ]);

            $requestUpdateProductDto = (new RequestUpdateProductDtoMapper())
                ->createFromRequest($request);

            $this->productsService->updateProduct($requestUpdateProductDto);

            return [
                'success' => true,
                'message' => "Se actualizo el producto exitosamente",
            ];
        });
    }

    public function deleteProduct(Request $request): array|JsonResponse
    {
        $this->useDbTransactions(true, ['pgsql']);
        return $this->execWithJsonSuccessResponse(function () use ($request) {
            $request->validate([
                'productId' => 'required|int|exists:products,id',
            ]);

            $productId = $request->get('productId');

            $this->productsService->deleteProduct($productId);

            return [
                'success' => true,
                'message' => "Se elimino el producto exitosamente",
            ];
        });
    }
}
