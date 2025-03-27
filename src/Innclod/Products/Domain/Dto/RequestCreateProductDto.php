<?php

namespace Innclod\Products\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestCreateProductDto extends BaseDto
{
    public string $name;
    public int $stock;
}
