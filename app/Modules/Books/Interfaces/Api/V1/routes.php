<?php

use App\Modules\Books\Interfaces\Api\V1\BookController;
use Illuminate\Support\Facades\Route;

Route::get('books', [BookController::class, 'index']);
Route::get('books/{bookId}', [BookController::class, 'show']);
