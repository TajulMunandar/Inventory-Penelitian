<?php

use App\Http\Controllers\AsetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VariantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.signin');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

    Route::resource('/barang', BarangController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/user', UserController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/unit', UnitController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/variant', VariantController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/aset', AsetController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::resource('/ruang', RuangController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::put('/resetpassword/{user}', [ResetPasswordController::class, 'resetPasswordAdmin'])->name('resetpassword.resetPasswordAdmin')->middleware('auth');


});

