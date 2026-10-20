<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController;

Route::apiResource('authors', AuthorController::class);
Route::apiResource(
    'book-types',
    \App\Http\Controllers\Api\BookTypeController::class
);
Route::apiResource(
    'books',
    \App\Http\Controllers\Api\BookController::class
);
Route::get('book-authors',
    [\App\Http\Controllers\Api\BookAuthorController::class, 'index']);

Route::post('book-authors',
    [\App\Http\Controllers\Api\BookAuthorController::class, 'store']);

Route::get('book-authors/{bookId}/{authorId}',
    [\App\Http\Controllers\Api\BookAuthorController::class, 'show']);

Route::match(['put', 'patch'], 'book-authors/{bookId}/{authorId}',
    [\App\Http\Controllers\Api\BookAuthorController::class, 'update']);

Route::delete('book-authors/{bookId}/{authorId}',
    [\App\Http\Controllers\Api\BookAuthorController::class, 'destroy']);