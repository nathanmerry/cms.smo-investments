<?php

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Websites

// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('/websites', [WebsiteController::class, 'index']);
// });

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/websites', [WebsiteController::class, 'index'])
    ->name('websites');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/websites/{website}/edit', [WebsiteController::class, 'show'])
    ->name('website');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/websites/save', [WebsiteController::class, 'update']);

// Route::get('/websites/{website}/edit', [WebsiteController::class, 'show'])->name('website');;
// Route::post('/websites/save', [WebsiteController::class, 'update']);

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/websites/create', [WebsiteController::class, 'create'])
    ->name('create');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/websites/store', [WebsiteController::class, 'store']);

// Route::get('/websites/create', [WebsiteController::class, 'create'])->name('create');
Route::post('/websites/store', [WebsiteController::class, 'store']);

// Route::post('/websites/slug', [WebsiteController::class, 'slug']);


// Companies
Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('company');
Route::post('/companies/save', [CompanyController::class, 'update']);

// Pages
Route::get('/pages', [PageController::class, 'index'])->name('pages');
Route::get('/pages/{page}', [PageController::class, 'show'])->name('page');
Route::post('/pages/save', [PageController::class, 'update']);

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');
