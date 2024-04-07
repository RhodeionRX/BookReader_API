<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signUp(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password')
        ]);
        $token = $user->createToken('key')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function signIn()
    {

    }
}
