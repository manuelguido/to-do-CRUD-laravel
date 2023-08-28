<?php

use App\Http\Controllers\API\TodoItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication endpoints
|--------------------------------------------------------------------------
*/
Route::resource('todo-item', TodoItemController::class)->middleware('auth:sanctum')->only([
  'index',
  'store',
  'show',
  'update',
  'destroy'
]);

Route::prefix('/todo-item')->controller(TodoItemController::class)->middleware('auth:sanctum')->group(function () {

  // Update todo item status
  Route::match(["put", "patch"], '/{todo_item}/status/', 'updateStatus');
});