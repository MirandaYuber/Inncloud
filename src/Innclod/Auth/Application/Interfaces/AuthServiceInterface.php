<?php

namespace Innclod\Auth\Application\Interfaces;

use Innclod\Auth\Domain\Dto\LoginDto;

interface AuthServiceInterface
{
    public function login(LoginDto $dto): self;
}
