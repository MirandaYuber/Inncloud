<?php

namespace Clients\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class getClientDto extends BaseDto
{
    public int $id;
    public string $name;
    public string $email;
}
