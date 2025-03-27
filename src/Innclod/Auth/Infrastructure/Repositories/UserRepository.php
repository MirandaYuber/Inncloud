<?php

namespace Innclod\Auth\Infrastructure\Repositories;

use App\Models\User;
use Yuber\Kernel\Infrastructure\Repositories\DbRepository;

class UserRepository extends DbRepository implements UserRepositoryInterface
{
    public function getTableName(): string
    {
        return 'users';
    }

    public function getDatabaseConnection(): string
    {
        return 'pgsql';
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', '=', $email)
            ->first();
    }

}
