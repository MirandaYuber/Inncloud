<?php

namespace Yuber\Kernel\Application\Mappers;

use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yuber\Kernel\Domain\Dto\BaseDto;

abstract class BaseMapper
{

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


    public function createFromRequest(Request $request):BaseDto
    {
        return $this->createFromArray($request->all());
    }


    public function createFromArray(array $data):BaseDto
    {
        $dto= $this->getNewDto();
        foreach ($data as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }

    abstract protected function getNewDto():BaseDto;

}

