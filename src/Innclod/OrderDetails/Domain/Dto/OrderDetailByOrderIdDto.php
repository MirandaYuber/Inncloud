<?php

namespace Innclod\OrderDetails\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class OrderDetailByOrderIdDto extends BaseDto
{
    public int $productId;
    public string $productName;
    public int $quantity;
}
