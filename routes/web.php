<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CarController;

Route::get('/postech/{nik}/{nama}/cek', [HaiController::class, 'index']);

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('users', UserController::class);
    Route::get('user-export', [UserController::class, 'export'])->name('user-export');
    Route::post('user-import', [UserController::class, 'import'])->name('user-import');
    Route::get('company-export', [CompanyController::class, 'export'])->name('company-export');
    Route::post('company-import', [CompanyController::class, 'import'])->name('company-import');
    Route::get('car-export', [CarController::class, 'export'])->name('car-export');
    Route::post('car-import', [CarController::class, 'import'])->name('car-import');

    Route::resource('companies', CompanyController::class);
    Route::resource('cars', CarController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sellings', SellingController::class);
    Route::get('report/sellings', [SellingController::class, 'report'])->name('sellings-report');
    Route::get('report/sellings/pdf', [SellingController::class, 'reportPdf'])->name('sellings-reportPdf');

});
