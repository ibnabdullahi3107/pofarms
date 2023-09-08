<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DispenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    Route::get('/all_products', [ProductController::class, 'index'])->name('all_product');
    Route::get('add_product', [ProductController::class, 'create'])->name('add_product');
    // Route to handle the product creation form submission
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');


    Route::get('/all_categories', [CategoryController::class,'index'])->name('all_categories');
    Route::get('add_categories', [CategoryController::class, 'create'])->name('add_categories');
    // Route for storing a category
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


    Route::get('add_dispense', [DispenseController::class, 'index'])->name('add_dispense');
    Route::post('/dispense', [DispenseController::class, 'store'])->name('dispense.store');



    Route::get('/clients', function(){
        return view('client');
    })->name('client.add');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
