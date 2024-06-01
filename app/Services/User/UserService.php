<?php

namespace App\Services\User;

use App\DTO\User\LoginUserDTO;
use App\DTO\User\RegisterUserDTO;
use App\Enums\Users\RoleEnum;
use App\Exceptions\ApiException;
use App\Repositories\User\IUserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected IUserRepositoryInterface $repository,
        protected RoleService $roleService
    ) {}
    public function register(RegisterUserDTO $dto)
    {
        DB::beginTransaction();

        try {
            $user = $this->repository->register($dto);
            $this->roleService->addRole($user, RoleEnum::User);

            DB::commit();

            return $user;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
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
