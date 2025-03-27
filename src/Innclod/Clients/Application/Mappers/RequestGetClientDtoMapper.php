<?php

namespace Clients\Application\Mappers;

use Clients\Domain\Dto\RequestGetClientDto;
use Illuminate\Http\Request;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestGetClientDtoMapper extends BaseMapper
{

    protected function getNewDto(): RequestGetClientDto
    {
        return new RequestGetClientDto();
    }

    public function createFromRequest(Request $request):RequestGetClientDto
    {
        return $this->createFromArray($request->all());
    }

    public function createFromArray(array $data):RequestGetClientDto
    {
        $dto= $this->getNewDto();
        foreach ($data as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }
}
