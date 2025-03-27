<?php

namespace ClientProduct\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class ClientProductDto extends BaseDto
{
    public int $id;
    public int $clientId;
    public int $productId;
}
