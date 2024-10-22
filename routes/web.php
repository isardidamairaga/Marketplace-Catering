<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('register/merchant', [RegisteredUserController::class, 'createMerchant'])->name('register.merchant');
Route::get('register/customer', [RegisteredUserController::class, 'createCustomer'])->name('register.customer');


Route::post('register/merchant', [RegisteredUserController::class, 'storeMerchant'])->name('register.store.merchant');
Route::post('register/customer', [RegisteredUserController::class, 'storeCustomer'])->name('register.store.customer');

Route::get('/dashboard', function () {
    return view('merchant');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Merchant Routes
    Route::middleware(['role:merchant'])->group(function () {
        Route::get('/merchant/profile', [MerchantController::class, 'profile'])->name('merchant.profile');
        Route::put('/merchant/profile', [MerchantController::class, 'updateProfile'])->name('merchant.profile.update');
        
        Route::resource('merchant/menus', MenuController::class);
        Route::get('/merchant/orders', [OrderController::class, 'merchantOrders'])->name('merchant.orders');
    });

    // Customer Routes
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/merchants', [CustomerController::class, 'searchMerchants'])->name('customer.merchants');
        Route::get('/merchants/{merchant}', [CustomerController::class, 'merchantDetails'])->name('customer.merchants.show');
        
        Route::post('/orders', [OrderController::class, 'store'])->name('customer.orders.store');
        Route::get('/orders', [OrderController::class, 'customerOrders'])->name('customer.orders');
    });
});

require __DIR__.'/auth.php';
