<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// ============================================================
//  Sklep – ścieżki
// ============================================================

Route::prefix('sklep')->name('sklep.')->group(function () {

    // Strona produktu
    Route::get('/', [ShopController::class, 'index'])->name('index');

    // Realizacja zamówienia (formularz → P24)
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('checkout');

    // Powrót z bramki płatności
    Route::get('/return',  [ShopController::class, 'return'])->name('return');
    Route::get('/success', [ShopController::class, 'success'])->name('success');
    Route::get('/cancel',  [ShopController::class, 'cancel'])->name('cancel');

    // Webhook Przelewy24 (IPN)
    Route::post('/notify', [ShopController::class, 'notify'])->name('notify')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});
