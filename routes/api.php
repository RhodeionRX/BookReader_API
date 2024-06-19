<?php

use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\BookImageController;
use App\Http\Controllers\Book\BookDetailsController;
use App\Http\Controllers\BookEntity\BookEntityController;
use App\Http\Controllers\BookEntity\BookPageController;
use App\Http\Controllers\User\UserController;
use App\Models\Book;
use App\Models\BookDetails;
use Illuminate\Support\Facades\Route;

// Authenticated users only
Route::middleware(['auth:sanctum'])->group(function () {
    // Books
    Route::prefix('/books')->group(function () {
        Route::post('/', [BookController::class, 'create']);
        Route::delete('/{book}', [BookController::class, 'destroy']);

        // Book details
        Route::middleware(['can:update,book'])->group(function () {
            Route::post('/{book}/details', [BookDetailsController::class, 'create']);
            Route::put('/{book}/details/{detail}', [BookDetailsController::class, 'update']);
        });
    });

    // Images
    Route::post('/books/images', [BookImageController::class, 'store']);
    Route::delete('/books/images/{id}', [BookImageController::class, 'destroy']);
    Route::put('/books/images/{id}', [BookImageController::class, 'update']);

    // Book Entity
    Route::post('/books/entity', [BookEntityController::class, 'store']);
    Route::put('/books/entity/{id}', [BookEntityController::class, 'update']);
    Route::delete('/books/entity/{id}', [BookEntityController::class, 'destroy']);

    // Book Entity Page
    Route::post('/books/entity/pages', [BookPageController::class, 'store']);
    Route::put('/books/entity/{entity_id}/pages/{number}', [BookPageController::class, 'update']);
    Route::delete('/books/entity/{entity_id}/pages/{number}', [BookPageController::class, 'destroy']);
});

// Unauthenticated
Route::middleware('guest')->group(function () {
    Route::post('/user/auth', [UserController::class, 'register']);
    Route::post('/user/login', [UserController::class, 'login']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);

    Route::get('/books/images/{id}', [BookImageController::class, 'show']);

    Route::get('/books/entity/{id}', [BookEntityController::class, 'show']);

});
