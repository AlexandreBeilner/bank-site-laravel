<?php

use Illuminate\Support\Facades\Route;

Route::resource('customers', App\Http\Controllers\CustomerController::class);
Route::resource('banks', App\Http\Controllers\BankController::class);

Route::get('/', function () {
    return view('layouts.app');
});
