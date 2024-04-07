<?php

namespace App\Http\Controllers;

use App\DTO\User\LoginUserDTO;
use App\DTO\User\RegisterUserDTO;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Resources\User\UserAuthResource;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function register(RegisterUserRequest $request)
    {
        $user = $this->service->register(
            RegisterUserDTO::fromRequest($request)
        );

        return response()->json([
            'token' => $user->createToken('key')->plainTextToken
        ], Response::HTTP_CREATED);
    }

    public function login(LoginUserRequest $request)
    {
        $user = $this->service->login(
            LoginUserDTO::fromRequest($request)
        );

        return response()->json([
            'token' => $user->createToken('key')->plainTextToken
        ], Response::HTTP_CREATED);
    }
}
