<?php

namespace Clients\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestGetClientDto extends BaseDto
{
    public string $typeFilter;
    public string $dataClient;

}
