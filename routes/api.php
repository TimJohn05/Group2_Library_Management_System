<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('api.auth')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/session-check', [AuthController::class, 'checkSession']);

    Route::apiResource('books', BookController::class);
    Route::get('/books/author/{authorId}', [BookController::class, 'byAuthor']);
    Route::get('/books/category/{categoryId}', [BookController::class, 'byCategory']);
    Route::get('/analytics', [BookController::class, 'analytics']);

    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('categories', CategoryController::class);
});