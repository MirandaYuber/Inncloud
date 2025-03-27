<?php

namespace Clients\Application\Mappers;

use Clients\Domain\Dto\RequestUpdateClientDto;
use Illuminate\Http\Request;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestUpdateClientDtoMapper extends BaseMapper
{

    protected function getNewDto(): RequestUpdateClientDto
    {
        return new RequestUpdateClientDto();
    }

    public function createFromRequest(Request $request):RequestUpdateClientDto
    {
        return $this->createFromArray($request->all());
    }


    public function createFromArray(array $data):RequestUpdateClientDto
    {
        $dto= $this->getNewDto();
        foreach ($data as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }
}
