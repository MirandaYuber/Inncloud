<?php

namespace Innclod\OrderDetails\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Innclod\OrderDetails\Application\Mappers\OrderDetailByOrderIdDtoMapper;
use Innclod\OrderDetails\Infrastructure\Interfaces\OrdersDetailsRepositoryInterface;
use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;
use Yuber\Kernel\Infrastructure\Repositories\DbRepository;

class OrdersDetailsRepository extends DbRepository implements OrdersDetailsRepositoryInterface
{

    public function getTableName(): string
    {
        return "orders_details";
    }

    public function getDatabaseConnection(): string
    {
        return 'pgsql';
    }

    public function createOrderDetails(int $orderId, int $productId, int $quantity): int
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->insert([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'created_at' => now(),
                ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }

    public function getOrderDetailByOrderId(int $orderId): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select([
                'products.id as productId',
                'name as productName',
                'quantity',
            ])
            ->join('products', 'products.id', '=', 'orders_details.product_id')
            ->where('orders_details.order_id', $orderId)
            ->get();

        return (new OrderDetailByOrderIdDtoMapper())
            ->createFromDbRecords($records);
    }
}
