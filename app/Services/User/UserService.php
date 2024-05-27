<?php

namespace App\Services\User;

use App\DTO\User\LoginUserDTO;
use App\DTO\User\RegisterUserDTO;
use App\Exceptions\ApiException;
use App\Repositories\User\IUserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected IUserRepositoryInterface $repository
    ) {}
    public function register(RegisterUserDTO $dto)
    {
        return $this->repository->register($dto);
    }

    public function login(LoginUserDTO $dto)
    {
        if (!filter_var($dto->identifier, FILTER_VALIDATE_EMAIL)) {
            $user = $this->repository->getByLogin($dto->identifier);
        } else {
            $user = $this->repository->getByEmail($dto->identifier);
        }

        if (!$user) {
            throw ApiException::Error('User not found', Response::HTTP_NOT_FOUND);
        }
        if (!Hash::check($dto->password, $user->password)) {
            throw ApiException::Error('Password is incorrect', Response::HTTP_UNAUTHORIZED);
        }

        return $user;
    }
}
