<?php

use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\BookImageController;
use App\Http\Controllers\Book\BookDetailsController;
use App\Http\Controllers\BookEntity\BookEntityController;
use App\Http\Controllers\BookEntity\BookPageController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\CheckBookAuthorization;
use App\Models\Book;
use App\Models\BookDetails;
use Illuminate\Support\Facades\Route;

// Authenticated users only
Route::middleware(['auth:sanctum'])->group(function () {
    // Books
    Route::prefix('/books')->group(function () {
        Route::post('/', [BookController::class, 'create']);
        Route::delete('/{book}', [BookController::class, 'destroy'])
            ->can('destroy', Book::class);

        Route::prefix('/{book}')->middleware(CheckBookAuthorization::class)
            ->group(function () {
                // Book details
                Route::post('/details', [BookDetailsController::class, 'create']);
                Route::put('/details/{detail}', [BookDetailsController::class, 'update']);

                // Images
                Route::post('/details/{detail}/images', [BookImageController::class, 'store']);
        });
//        Route::->group(function () {
//
//
//
//            Route::put('/{book}/details/{detail}/images/{image}', [BookImageController::class, 'update']);
//            Route::delete('/{book}/details/{detail}/images/{image}', [BookImageController::class, 'destroy']);
//        });
    });

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
