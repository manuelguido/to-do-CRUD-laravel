<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public endpoints for SPA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
  return view('app');
});

Route::get('/{pathMatch}', function () {
  return view('app');
})->where('pathMatch', '.*');