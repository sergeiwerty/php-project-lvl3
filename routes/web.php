<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\CheckController;

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

//Route::post('urls/{id}/checks', [CheckController::class, 'addCheck']);
Route::resource('urls.checks', CheckController::class);
