<?php

namespace Clients\Application\Mappers;

use Clients\Domain\Dto\RequestCreateClientDto;
use Illuminate\Http\Request;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestCreateClientDtoMapper extends BaseMapper
{

    protected function getNewDto(): RequestCreateClientDto
    {
        return new RequestCreateClientDto();
    }

    public function createFromRequest(Request $request):RequestCreateClientDto
    {
        return $this->createFromArray($request->all());
    }


    public function createFromArray(array $data):RequestCreateClientDto
    {
        $dto= $this->getNewDto();
        foreach ($data as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }
}
