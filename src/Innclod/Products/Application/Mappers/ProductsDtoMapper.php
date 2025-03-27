<?php

namespace Innclod\Products\Application\Mappers;

use Illuminate\Support\Collection;
use Innclod\Products\Domain\Dto\ProductsDto;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class ProductsDtoMapper extends BaseMapper
{

    protected function getNewDto(): ProductsDto
    {
        return new ProductsDto();
    }

    public function createFromDbRecord($dbRecord):BaseDto
    {
        $dto= $this->getNewDto();
        foreach ($dbRecord as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }

    public function createFromDbRecords(Collection $dbRecords):array
    {
        $dtos= [];
        foreach ($dbRecords as $dbRecord){
            $dtos[]= $this->createFromDbRecord($dbRecord);
        }
        return $dtos;
    }
}
