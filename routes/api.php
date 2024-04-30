<?php

use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\BookImageController;
use App\Http\Controllers\Book\BookDetailsController;
use App\Http\Controllers\BookEntity\BookEntityController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Authenticated users only
Route::middleware(['auth:sanctum'])->group(function () {
    // Books and its translations
    Route::post('/books', [BookController::class, 'create']);
    Route::post('/books/details', [BookDetailsController::class, 'add']);
    Route::put('/books/details/{id}', [BookDetailsController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

    // Images
    Route::post('/books/images', [BookImageController::class, 'store']);
    Route::delete('/books/images/{id}', [BookImageController::class, 'destroy']);
    Route::put('/books/images/{id}', [BookImageController::class, 'update']);

    // Book Entity
    Route::post('/books/entity', [BookEntityController::class, 'store']);
    Route::put('/books/entity/{id}', [BookEntityController::class, 'update']);
    Route::delete('/books/entity/{id}', [BookEntityController::class, 'destroy']);
});

// Unauthenticated
Route::middleware('guest')->group(function () {
    Route::post('/user/auth', [UserController::class, 'register']);
    Route::post('/user/login', [UserController::class, 'login']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);

    Route::get('/books/images/{id}', [BookImageController::class, 'show']);
});
