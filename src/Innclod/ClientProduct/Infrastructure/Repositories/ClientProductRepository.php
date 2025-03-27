<?php

namespace ClientProduct\Infrastructure\Repositories;

use ClientProduct\Application\Mappers\ClientProductDtoMapper;
use ClientProduct\Domain\Dto\ClientProductDto;
use ClientProduct\Infrastructure\Interfaces\Repositories\ClientProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Yuber\Kernel\Infrastructure\Repositories\DbRepository;

class ClientProductRepository extends DbRepository implements ClientProductRepositoryInterface
{

    public function getTableName(): string
    {
        return 'client_product';
    }

    public function getDatabaseConnection(): string
    {
        return 'pgsql';
    }

    public function deletedClientProductByClient(int $clientId): void
    {
        try {
            DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->where('client_id', $clientId)
                ->delete();

        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }

    }

    public function createClientProduct(int $product, int $clientId): bool
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->insert([
                    'client_id' => $clientId,
                    'product_id' => $product,
                    'created_at' => now()
                ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getProductIdByClientId(int $clientId): array
    {
        try {
            $records = DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->select('product_id')
                ->where('client_id', $clientId)
                ->where('deleted_at', '=', null)
                ->get();

            return $records->toArray();

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
