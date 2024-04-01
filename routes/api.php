<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/books', [BookController::class, 'init']);
Route::get('/books', [BookController::class, 'index']);
//Route::get('/languages', [LanguageController::class, 'index']);
//Route::get('/languages/{id}', [LanguageController::class, 'show']);
//Route::post('/languages', [LanguageController::class, 'store']);
//Route::delete('/languages/{id}', [LanguageController::class, 'delete']);
