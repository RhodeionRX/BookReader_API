<?php

namespace App\DTO\User;

use App\Http\Requests\User\LoginUserRequest;

final class LoginUserDTO
{
    public function __construct(
        readonly public string $identifier,
        readonly public string $password
    ) {}
    public static function fromRequest(LoginUserRequest $request)
    {
        return new self(
            identifier: $request->validated('login') ?: $request->validated('email'),
//            email: $request->validated('email'),
            password: $request->validated('password'),
        );
    }
    public static function fromValues(string $identifier, string $password)
    {
        return new self(
            identifier: $identifier,
//            email: $email,
            password: $password
        );
    }
}
