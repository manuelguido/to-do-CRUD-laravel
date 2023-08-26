<?php

use App\Http\Controllers\API\AuthenticationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication endpoints
|--------------------------------------------------------------------------
*/
Route::controller(AuthenticationController::class)->group(function () {

    // Register
    Route::post('/register', 'register');

    // Login
    Route::post('/login', 'authenticate');

    // Logout
    Route::post('/logout', 'logout')->middleware(['auth:sanctum']);
});
