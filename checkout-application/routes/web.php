<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::view('/success', 'success')->name('success');
Route::get('/{invoice_id}', [IndexController::class, 'index']);
Route::post('/process-payment', [PaymentController::class, 'processPayment'])
    ->name('process.payment');


Route::fallback(function () {
    abort(404); 
});
