<?php

namespace Innclod\Orders\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class GetOrdersDto extends BaseDto
{
    public int $id;
    public string $createdAt;
    public string $clientName;
}
