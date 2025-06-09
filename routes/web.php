<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'api/v1'], function () {
    require  __DIR__ . '/../app/Modules/Books/Presentation/Api/V1/routes.php';
});
