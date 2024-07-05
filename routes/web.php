<?php

use App\Http\Controllers\HobbyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('user', UserController::class);
Route::resource('hobby', HobbyController::class);
Route::resource('/users', UserController::class);
