<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeController::class)->middleware('auth')->name('home');

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::post('/', [AuthController::class, 'auth'])->name('auth');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register_form'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/profille', [UserController::class, 'profile'])->name('users.profile');
    Route::put('/profille', [UserController::class, 'update_profile'])->name('users.update_profile');
    Route::put('/update-biodata/{id}', [UserController::class, 'update_biodata'])->name('users.update_biodata');
    Route::get('/edit-biodata/{id}', [UserController::class, 'edit_biodata'])->name('users.edit_biodata');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});