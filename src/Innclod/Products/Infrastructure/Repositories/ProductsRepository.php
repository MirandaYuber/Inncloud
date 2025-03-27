<?php

namespace Innclod\Products\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Innclod\Products\Application\Mappers\ProductsDtoMapper;
use Innclod\Products\Domain\Dto\RequestCreateProductDto;
use Innclod\Products\Domain\Dto\RequestUpdateProductDto;
use Innclod\Products\Infrastructure\Interfaces\Repositories\ProductsRepositoryInterface;
use Yuber\Kernel\Infrastructure\Repositories\DbRepository;

class ProductsRepository extends DbRepository implements ProductsRepositoryInterface
{

    public function getTableName(): string
    {
        return "products";
    }

    public function getDatabaseConnection(): string
    {
        return "pgsql";
    }

    public function getAllProducts(): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select(['id', 'name', 'stock'])
            ->where('deleted_at', '=', null)
            ->orderBy('id', 'asc')
            ->get();

        return (new ProductsDtoMapper())
            ->createFromDbRecords($records);
    }

    public function getProductsById(array $productsId): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select(['id', 'name', 'stock'])
            ->whereIn('id', $productsId)
            ->where('stock', '>', 0)
            ->where('deleted_at', '=', null)
            ->get();

        return (new ProductsDtoMapper())
            ->createFromDbRecords($records);
    }

    public function getProductsByName(string $productName): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select(['id', 'name', 'stock'])
            ->where('name', 'ilike', $productName . '%')
            ->where('deleted_at', '=', null)
            ->orderBy('id', 'asc')
            ->get();

        return (new ProductsDtoMapper())
            ->createFromDbRecords($records);
    }

    public function createProduct(RequestCreateProductDto $requestCreateProductDto): bool
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->insert([
                    'name' => $requestCreateProductDto->name,
                    'stock' => $requestCreateProductDto->stock,
                    'created_at' => now()
                ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateProduct(RequestUpdateProductDto $requestUpdateProductDto): bool
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->where('id', $requestUpdateProductDto->productId)
                ->update([
                    'name' => $requestUpdateProductDto->name,
                    'stock' => $requestUpdateProductDto->stock,
                    'updated_at' => now(),
                ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function deleteProduct(int $productId): bool
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->where('id', $productId)
                ->update([
                    'deleted_at' => now(),
                ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function getProductStockAvailableById(int $productId): int
    {
        $record = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select(['stock'])
            ->where('id', $productId)
            ->where('deleted_at', '=', null)
            ->get();

        if (count($record) === 0) {
            throw new \Exception("No se encontro producto con id $productId");
        }

        return $record[0]->stock;
    }

    public function updateStockProduct(int $productId, int $newStock): int
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->where('id', $productId)
                ->update([
                    'stock' => $newStock,
                    'updated_at' => now(),
                ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
