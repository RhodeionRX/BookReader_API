<?php

namespace App\DTO\User;

use App\Http\Requests\User\RegisterUserRequest;

final class RegisterUserDTO
{
    public function __construct(
        readonly public string $nickname,
        readonly public string $login,
        readonly public string $email,
        readonly public string $password
    ) {}
    public static function fromRequest(RegisterUserRequest $request)
    {
        return new self(
            nickname: $request->validated('nickname'),
            login: $request->validated('login'),
            email: $request->validated('email'),
            password: $request->validated('password'),
        );
    }
    public static function fromValues(string $nickname, string $login, string $email, string $password)
    {
        return new self(
            nickname: $nickname,
            login: $login,
            email: $email,
            password: $password
        );
    }
}
