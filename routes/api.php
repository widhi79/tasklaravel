<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TasksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Task Routes
Route::middleware('auth:api')->group(function () {
    Route::get('/tasks', [TasksController::class, 'index']);
    Route::get('/tasks/{id}', [TasksController::class, 'show']);
    Route::post('/tasks', [TasksController::class, 'store']);
    Route::put('/tasks/{id}', [TasksController::class, 'update']);
    Route::delete('/tasks/{id}', [TasksController::class, 'destroy']);

    Route::get('/tasks2/{id}', [TasksController::class, 'show2']);
});

// Category Routes
Route::middleware('auth:api')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});

// Users Routes
Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/{id}', [UsersController::class, 'show']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::put('/users/{id}', [UsersController::class, 'update']);
    //Route::delete('/users/{id}', [UsersController::class, 'destroy']);
});


