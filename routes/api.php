<?php

use App\Http\Controllers\Api\EmailValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Email validation endpoint (no auth required)
Route::post('/check-email', [EmailValidationController::class, 'checkEmail'])
    ->middleware('throttle:60,1');

// Your other API routes...
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});