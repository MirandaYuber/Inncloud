<?php

namespace Clients\Application\Interfaces\Services;

use Clients\Domain\Dto\RequestCreateClientDto;
use Clients\Domain\Dto\RequestGetClientDto;
use Clients\Domain\Dto\RequestUpdateClientDto;

interface ClientsServiceInterface
{
    public function getClientsByFilter(RequestGetClientDto $requestGetClientDto);

    public function getClientsAll();

    public function createClient(RequestCreateClientDto $requestCreateClientDto);

    public function updateClient(RequestUpdateClientDto $requestUpdateClientDto);

    public function deleteClient(int $clientId);
}
