<?php

use App\Http\Controllers\Api\EmailValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Email validation endpoint (no auth required)
Route::post('/check-email', [EmailValidationController::class, 'checkEmail'])
    ->name('api.check-email');

// Your other API routes...
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});