<?php

namespace Clients\Infrastructure\Interfaces\Repositories;

use Clients\Domain\Dto\RequestCreateClientDto;
use Clients\Domain\Dto\RequestUpdateClientDto;

interface ClientsRepositoryInterface
{
    public function getClientByName(string $name): array;

    public function getClientByEmail(string $email): array;
    public function getClientAll(): array;

    public function createClient(RequestCreateClientDto $requestCreateClientDto): int;

    public function updateClient(RequestUpdateClientDto $requestUpdateClientDto): int;

    public function deleteClient(int $clientId): bool;

}
