<?php

namespace Clients\Application\Mappers;

use Clients\Domain\Dto\getClientDto;
use Illuminate\Support\Collection;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class getClientDtoMapper extends BaseMapper
{

    protected function getNewDto(): BaseDto
    {
        return new getClientDto();
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
