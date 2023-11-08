<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DispenseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BankTransactionController;
use App\Http\Controllers\ProductQuantityController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {


    Route::resource('companies', 'App\Http\Controllers\CompanyController');

    Route::resource('users', UserController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('clients', ClientController::class);

    Route::resource('products', ProductController::class);

    Route::get('/get-categories/{companyId}', [ProductController::class, 'getCategoriesByCompany']);

    Route::get('/get-products-by-company/{companyId}', [ProductQuantityController::class, 'getProductsByCompany'])->name('get-products-by-company');

    Route::resource('suppliers', SupplierController::class);

    Route::resource('product_quantities', ProductQuantityController::class);

    Route::resource('bank', BankController::class);

    Route::resource('bank_transactions', BankTransactionController::class);

    Route::get('/get-banks-by-company/{company}', [BankTransactionController::class, 'getBanksByCompany'])->name('get-banks-by-company');





    Route::get('add_dispense', [DispenseController::class, 'index'])->name('add_dispense');
    Route::post('/dispense', [DispenseController::class, 'store'])->name('dispense.store');



    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
