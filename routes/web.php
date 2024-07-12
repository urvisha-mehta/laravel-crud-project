<?php

use App\Http\Controllers\StateController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/users', UserController::class);
Route::get('fetch-states', [StateController::class, 'fetchState'])->name('fetch-states');
Route::get('get-active-status', [StatusController::class, 'statusActive'])->name('get-active-status');
Route::get('get-in-active-status', [StatusController::class, 'statusInActive'])->name('get-in-active-status');
