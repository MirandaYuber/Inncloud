<?php

namespace Innclod\Auth\Domain\Dto;

use Yuber\Kernel\Domain\Dto\BaseDto;

class LoginDto extends BaseDto
{
    public string $email;

    public string $password;
}
