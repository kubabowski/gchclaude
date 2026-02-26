<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/sklep', [ShopController::class, 'index'])->name('shop.index');
Route::post('/sklep/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
Route::get('/sklep/return', [ShopController::class, 'paymentReturn'])->name('shop.return');
Route::post('/sklep/notify', [ShopController::class, 'paymentNotify'])->name('shop.notify');
