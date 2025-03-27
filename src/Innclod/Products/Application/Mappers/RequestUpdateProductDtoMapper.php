<?php

namespace Innclod\Products\Application\Mappers;

use Illuminate\Http\Request;
use Innclod\Products\Domain\Dto\RequestUpdateProductDto;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class RequestUpdateProductDtoMapper extends BaseMapper
{

    protected function getNewDto(): RequestUpdateProductDto
    {
        return new RequestUpdateProductDto();
    }

    public function createFromRequest(Request $request):RequestUpdateProductDto
    {
        return $this->createFromArray($request->all());
    }


    public function createFromArray(array $data):RequestUpdateProductDto
    {
        $dto= $this->getNewDto();
        foreach ($data as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }
}
