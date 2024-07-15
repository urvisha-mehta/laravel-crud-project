<?php

use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/users', UserController::class);
Route::get('fetch-states', [StateController::class, 'fetchState'])->name('fetch-states');
