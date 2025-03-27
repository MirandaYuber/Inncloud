<?php

namespace Clients\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestCreateClientDto extends BaseDto
{
    public string $name;
    public string $email;
    public array $products;
}
