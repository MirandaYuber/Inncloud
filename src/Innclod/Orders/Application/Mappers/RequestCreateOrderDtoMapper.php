<?php

namespace Innclod\Orders\Application\Mappers;

use Illuminate\Http\Request;
use Innclod\Orders\Domain\Dto\RequestCreateOrderDto;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestCreateOrderDtoMapper extends BaseMapper
{

    protected function getNewDto(): RequestCreateOrderDto
    {
        return new RequestCreateOrderDto();
    }

    public function createFromRequest(Request $request):RequestCreateOrderDto
    {
        return $this->createFromArray($request->all());
    }


    public function createFromArray(array $data):RequestCreateOrderDto
    {
        $dto= $this->getNewDto();
        foreach ($data as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }
}
