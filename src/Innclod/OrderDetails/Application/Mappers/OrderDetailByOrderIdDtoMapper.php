<?php

namespace Innclod\OrderDetails\Application\Mappers;

use Illuminate\Support\Collection;
use Innclod\OrderDetails\Domain\Dto\OrderDetailByOrderIdDto;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class OrderDetailByOrderIdDtoMapper extends BaseMapper
{

    protected function getNewDto(): OrderDetailByOrderIdDto
    {
        return new OrderDetailByOrderIdDto();
    }

    public function createFromDbRecord($dbRecord):OrderDetailByOrderIdDto
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
