<?php

namespace Innclod\Products\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class ProductsDto extends BaseDto
{
    public int $id;
    public string $name;
    public int $stock;
}
