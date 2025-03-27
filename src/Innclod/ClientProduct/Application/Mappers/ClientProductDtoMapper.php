<?php

namespace ClientProduct\Application\Mappers;

use ClientProduct\Domain\Dto\ClientProductDto;
use Illuminate\Support\Collection;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class ClientProductDtoMapper extends BaseMapper
{

    protected function getNewDto(): ClientProductDto
    {
        return new ClientProductDto();
    }

    public function createFromDbRecord($dbRecord):ClientProductDto
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
