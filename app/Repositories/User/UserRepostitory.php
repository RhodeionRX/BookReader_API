<?php

namespace App\Repositories\User;

use App\DTO\User\LoginUserDTO;
use App\DTO\User\RegisterUserDTO;
use App\Models\User;

class UserRepostitory implements UserRepositoryInterface
{

    public function register(RegisterUserDTO $dto)
    {
        return User::create([
            'nickname' => $dto->nickname,
            'login' => $dto->login,
            'email' => $dto->email,
            'password' => $dto->password
        ]);
    }

    public function getOne(int $id)
    {
        return User::findOrFail($id);
    }

    public function getByEmail(string $email)
    {
        return User::firstWhere('email', $email);
    }

    public function getByLogin(string $login)
    {
        return User::firstWhere('login', $login);
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
