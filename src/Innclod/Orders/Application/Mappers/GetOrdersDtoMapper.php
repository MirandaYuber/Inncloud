<?php

namespace Innclod\Orders\Application\Mappers;

use Illuminate\Support\Collection;
use Innclod\Orders\Domain\Dto\GetOrdersDto;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class GetOrdersDtoMapper extends BaseMapper
{

    protected function getNewDto(): GetOrdersDto
    {
        return new GetOrdersDto();
    }

    public function createFromDbRecord($dbRecord):GetOrdersDto
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
