<?php

namespace Innclod\Products\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestUpdateProductDto extends BaseDto
{
    public int $productId;
    public string $name;
    public int $stock;
}
