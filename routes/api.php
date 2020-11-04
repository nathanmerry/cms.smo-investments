<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/website-ftp', [WebsiteController::class, 'storeNewSiteFiles']);
Route::middleware('auth:api')->get('/check-ftp-login', [WebsiteController::class, 'checkFtpLogin']);

Route::post('/website-store', [WebsiteController::class, 'store']);