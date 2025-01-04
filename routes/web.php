<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthControllerCompany;
use App\Http\Controllers\Auth\AuthControllerCustomer;
use App\Http\Controllers\Auth\AuthControllerTransaction;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TransactionController;

Route::get('/postech/{nik}/{nama}/cek', [HaiController::class, 'index']);

Route::get('/filter-cars', [DashboardController::class, 'filterCars']);
Route::get('/get-provinces', [AuthControllerCustomer::class, 'getProvinces'])->name('getProvinces');
Route::get('/get-cities', [AuthControllerCustomer::class, 'getCities'])->name('getCities');
Route::get('/get-subdistricts', [AuthControllerCustomer::class, 'getSubdistricts'])->name('getSubdistricts');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('registrationCompany', [AuthControllerCompany::class, 'registration'])->name('registerCompany');
Route::post('post-registrationCompany', [AuthControllerCompany::class, 'postRegistration'])->name('registerCompany.post');
Route::get('registrationCustomer', [AuthControllerCustomer::class, 'registration'])->name('registerCustomer');
Route::post('post-registrationCustomer', [AuthControllerCustomer::class, 'postRegistration'])->name('registerCustomer.post');
Route::get('registrationTransaction/{id}', [AuthControllerTransaction::class, 'registration'])->name('registerTransaction');
Route::get('registrationTransaction2/{id}', [AuthControllerTransaction::class, 'registration2'])->name('registerTransaction2');
Route::post('post-registrationTransaction', [AuthControllerTransaction::class, 'postRegistration'])->name('registerTransaction.post');
Route::post('post-registrationTransaction2', [AuthControllerTransaction::class, 'postRegistration2'])->name('registerTransaction.post2');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('customers', CustomerController::class);

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('users', UserController::class)->middleware('admin');
    Route::get('user-export', [UserController::class, 'export'])->name('user-export');
    Route::post('user-import', [UserController::class, 'import'])->name('user-import');
    Route::get('company-export', [CompanyController::class, 'export'])->name('company-export');
    Route::post('company-import', [CompanyController::class, 'import'])->name('company-import');
    Route::get('car-export', [CarController::class, 'export'])->name('car-export');
    Route::post('car-import', [CarController::class, 'import'])->name('car-import');

    Route::resource('companies', CompanyController::class)->middleware('admin');
    Route::resource('cars', CarController::class)->middleware('company');
    Route::resource('transactions', TransactionController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sellings', SellingController::class);
    Route::get('report/sellings', [SellingController::class, 'report'])->name('sellings-report');
    Route::get('report/sellings/pdf', [SellingController::class, 'reportPdf'])->name('sellings-reportPdf');

});
