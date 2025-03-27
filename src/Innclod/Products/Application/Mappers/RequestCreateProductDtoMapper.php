<?php

namespace Innclod\Products\Application\Mappers;

use Illuminate\Http\Request;
use Innclod\Products\Domain\Dto\RequestCreateProductDto;
use Yuber\Kernel\Application\Mappers\BaseMapper;

class RequestCreateProductDtoMapper extends BaseMapper
{

    protected function getNewDto(): RequestCreateProductDto
    {
        return new RequestCreateProductDto();
    }

    public function createFromRequest(Request $request):RequestCreateProductDto
    {
        return $this->createFromArray($request->all());
    }


    public function createFromArray(array $data):RequestCreateProductDto
    {
        $dto= $this->getNewDto();
        foreach ($data as $key=> $value){
            $dto->{$key}= $value;
        }
        return $dto;
    }
}
