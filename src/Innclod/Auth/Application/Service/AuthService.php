<?php

namespace Innclod\Auth\Application\Service;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Innclod\Auth\Application\Interfaces\AuthServiceInterface;
use Innclod\Auth\Domain\Dto\LoginDto;
use Innclod\Auth\Infrastructure\Repositories\UserRepository;
use Innclod\Auth\Infrastructure\Repositories\UserRepositoryInterface;

class AuthService implements AuthServiceInterface
{
    protected UserRepositoryInterface $userRepo;

    public function __construct()
    {
        $this->initializeDependencies();
    }

    protected function initializeDependencies(): void
    {
        $this->userRepo = App::make(UserRepositoryInterface::class);
    }

    public function login(LoginDto $dto): AuthServiceInterface
    {
        $user = $this->userRepo->findUserByEmail($dto->email);

        throw_if(is_null($user), new \Exception('Usuario no encontrado'));

        throw_if(!Hash::check($dto->password, $user->password), new \Exception('Credenciales invalidas'));

        auth()->login($user);

        return $this;

    }

}
