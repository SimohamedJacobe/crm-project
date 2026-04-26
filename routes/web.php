<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('companies', CompanyController::class);
Route::resource('contacts', ContactController::class);
Route::resource('deals', DealController::class);
