<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('/auth/login');
//});
// Rute root
Route::get('/', function () {
    // Mengarahkan ke halaman login jika belum login, dan ke halaman home jika sudah
    //return auth()->check() ? redirect()->route('home') : redirect()->route('login');
    return view('home');
});

//Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
//});

//Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class,'index'])->name('home');
//});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/category', [CategoryController::class,'layout'])->name('category');
Route::get('/users', [UsersController::class,'layout'])->name('users');
Route::get('/tasks', [TasksController::class,'layout'])->name('tasks');

