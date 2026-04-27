<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealController;

Route::get('/', function () {
    return view('welcome', [
        'companiesCount' => \App\Models\Company::count(),
        'contactsCount'  => \App\Models\Contact::count(),
        'dealsCount'     => \App\Models\Deal::count(),
        'totalValue'     => \App\Models\Deal::sum('amount'),
        'wonCount'       => \App\Models\Deal::where('stage', 'Won')->count(),
        'recentDeals'    => \App\Models\Deal::with(['company', 'contact'])->latest()->limit(5)->get(),
    ]);
});

Route::resource('companies', CompanyController::class);
Route::resource('contacts', ContactController::class);
Route::resource('deals', DealController::class);
