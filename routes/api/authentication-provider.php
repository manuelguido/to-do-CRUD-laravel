<?php

use App\Http\Controllers\API\AuthenticationProviderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication route
|--------------------------------------------------------------------------
*/

Route::get('/login/{provider}', [AuthenticationProviderController::class, 'redirectToProvider']);

Route::get('/login/{provider}/callback', [AuthenticationProviderController::class, 'handleProviderCallback']);