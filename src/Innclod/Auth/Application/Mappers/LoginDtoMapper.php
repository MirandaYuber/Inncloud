<?php

namespace Innclod\Auth\Application\Mappers;

use Illuminate\Http\Request;
use Innclod\Auth\Domain\Dto\LoginDto;
use Yuber\Kernel\Application\Mappers\BaseMapper;
use Yuber\Kernel\Domain\Dto\BaseDto;

class LoginDtoMapper extends BaseMapper
{
    protected function getNewDto(): LoginDto
    {
        return new LoginDto();
    }

    public function createFromRequest(Request $request): LoginDto
    {
        $dto = $this->getNewDto();
        $dto->email = $request->get('email');
        $dto->password = $request->get('password');
        return $dto;
    }

}
