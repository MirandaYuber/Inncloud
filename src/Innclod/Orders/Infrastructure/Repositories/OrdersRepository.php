<?php

namespace Innclod\Orders\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Innclod\Orders\Application\Mappers\GetOrdersDtoMapper;
use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;
use Innclod\Orders\Infrastructure\Interfaces\OrdersRepositoryInterface;
use Yuber\Kernel\Infrastructure\Repositories\DbRepository;

class OrdersRepository extends DbRepository implements OrdersRepositoryInterface
{

    public function getTableName(): string
    {
        return "orders";
    }

    public function getDatabaseConnection(): string
    {
        return "pgsql";
    }

    public function createOrder(int $clientId): int
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->insertGetId([
                    'client_id' => $clientId,
                    'created_at' => now(),
                ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function getAllOrders(): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select([
                'orders.id',
                'orders.created_at as createdAt',
                'clients.name as clientName'
            ])
            ->join(
                'clients', 'clients.id', '=', 'orders.client_id'
            )
            ->get();

        return (new GetOrdersDtoMapper())
            ->createFromDbRecords($records);
    }

    public function getOrdesByClientId(int $clientId): array
    {
        $record = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select([
                'orders.id',
                'orders.created_at as createdAt',
                'clients.name as clientName'
            ])
            ->join(
                'clients', 'clients.id', '=', 'orders.client_id'
            )
            ->where('clients.id', '=', $clientId)
            ->get();

        return (new GetOrdersDtoMapper())
            ->createFromDbRecords($record);
    }
}
