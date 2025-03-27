<?php

namespace Innclod\Orders\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestCreateOrderDto extends BaseDto
{
    public int $clientId;
    public array $listProducts;
    public int $orderId;
}
