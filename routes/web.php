<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

/*
|--------------------------------------------------------------------------
| Page analyzer application
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Route::post('/urls', [UrlController::class, store])
//    ->name();

Route::resource('urls', UrlController::class);
