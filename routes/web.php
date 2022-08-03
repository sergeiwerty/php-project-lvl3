<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Page analyzer application
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Route::post('/urls', [FormController::class, store])
//    ->name();

Route::resource('urls', FormController::class);
