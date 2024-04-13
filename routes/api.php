<?php

use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\BookImageController;
use App\Http\Controllers\Book\BookLocalizationController;
use App\Http\Controllers\User\UserController;
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
    Route::post('/books', [BookController::class, 'create']);
    Route::post('/books/localization', [BookLocalizationController::class, 'add']);
    Route::put('/books/localization/{id}', [BookLocalizationController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

//    Route::resource('/books/images', 'BookImageController');
    Route::post('/books/images', [BookImageController::class, 'store']);
    Route::delete('/books/images/{id}', [BookImageController::class, 'destroy']);
    Route::put('/books/images/{id}', [BookImageController::class, 'update']);
});

// Unauthenticated
Route::middleware('guest')->group(function () {
    Route::post('/user/auth', [UserController::class, 'register']);
    Route::post('/user/login', [UserController::class, 'login']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);

    Route::get('/books/images/{id}', [BookImageController::class, 'show']);
});
