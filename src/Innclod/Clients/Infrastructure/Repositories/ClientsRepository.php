<?php

namespace Clients\Infrastructure\Repositories;

use ClientProduct\Domain\Exceptions\DuplicateKeyException;
use Clients\Application\Mappers\getClientDtoMapper;
use Clients\Domain\Dto\RequestCreateClientDto;
use Clients\Domain\Dto\RequestUpdateClientDto;
use Clients\Infrastructure\Interfaces\Repositories\ClientsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Yuber\Kernel\Infrastructure\Repositories\DbRepository;

class ClientsRepository extends DbRepository implements ClientsRepositoryInterface
{

    public function getTableName(): string
    {
        return 'clients';
    }

    public function getDatabaseConnection(): string
    {
        return 'pgsql';
    }

    public function getClientByName(string $name): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select('id', 'name', 'email')
            ->where('name','ilike', $name . '%')
            ->where('deleted_at', '=', null)
            ->orderBy('id', 'asc')
            ->get();

        return (new getClientDtoMapper())
            ->createFromDbRecords($records);
    }

    public function getClientByEmail(string $email): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select('id', 'name', 'email')
            ->where('email', 'ilike', $email . '%')
            ->where('deleted_at', '=', null)
            ->orderBy('id', 'asc')
            ->get();

        return (new getClientDtoMapper())
            ->createFromDbRecords($records);
    }

    public function getClientAll(): array
    {
        $records = DB::connection($this->getDatabaseConnection())
            ->table($this->getTableName())
            ->select('id', 'name', 'email')
            ->where('deleted_at', '=', null)
            ->orderBy('id', 'asc')
            ->get();

        return (new getClientDtoMapper())
            ->createFromDbRecords($records);
    }

    public function createClient(RequestCreateClientDto $requestCreateClientDto): int
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->insertGetId([
                    'name' => $requestCreateClientDto->name,
                    'email' => $requestCreateClientDto->email,
                    'created_at' => now()
                ]);

        } catch (\Exception $exception) {
            if ($exception->getCode() == 23505) {
                throw new DuplicateKeyException();
            }
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateClient(RequestUpdateClientDto $requestUpdateClientDto): int
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->where('id', $requestUpdateClientDto->id)
                ->update([
                    'name' => $requestUpdateClientDto->name,
                    'email' => $requestUpdateClientDto->email,
                    'updated_at' => now()
                ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function deleteClient(int $clientId): bool
    {
        try {
            return DB::connection($this->getDatabaseConnection())
                ->table($this->getTableName())
                ->where('id', $clientId)
                ->update([
                    'deleted_at' => now()
                ]);

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
