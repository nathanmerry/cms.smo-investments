<?php

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Websites
    Route::get('/websites', [WebsiteController::class, 'index'])->name('websites');
    Route::get('/websites/{website}/edit', [WebsiteController::class, 'show'])->name('website');;
    Route::post('/websites/save', [WebsiteController::class, 'update']);
    Route::get('/websites/create', [WebsiteController::class, 'create'])->name('create');
    Route::get('/websites/store', [WebsiteController::class, 'store']);

    // companies
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('company');
    Route::post('/companies/save', [CompanyController::class, 'update']);

    // Pages
    Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/pages/{page}', [PageController::class, 'show'])->name('page');
    Route::post('/pages/save', [PageController::class, 'update']);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');
