<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

//Route::post('/user/auth', function (Request $request) {
//    $token = $request->$user()->createToken($request->token_name);
//    return ['token' => $token->plainTextToken];
//});

// Authenticated users only
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/books', [BookController::class, 'init']);
    Route::post('/books/localization', [BookController::class, 'add']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});

// Unauthenticated
Route::middleware('guest')->group(function () {
    Route::post('/user/auth', [UserController::class, 'register']);
    Route::post('/user/login', [UserController::class, 'login']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
});
