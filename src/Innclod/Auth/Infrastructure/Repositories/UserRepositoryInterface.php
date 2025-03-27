<?php

namespace Innclod\Auth\Infrastructure\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findUserByEmail(string $email): ?User;
}
