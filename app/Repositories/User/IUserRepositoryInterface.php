<?php

namespace App\Repositories\User;

use App\DTO\User\LoginUserDTO;
use App\DTO\User\RegisterUserDTO;

interface IUserRepositoryInterface
{
    public function register(RegisterUserDTO $dto);
    public function getOne(int $id);
    public function getByEmail(string $email);
    public function getByLogin(string $login);
    public function getAll();
    public function update();
    public function delete();
}
