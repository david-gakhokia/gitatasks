<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/pay', function () {
    return view('pay');
});

Route::get('/getToken', [PaymentController::class, 'getAccessToken'])->name('getToken');
Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
// დამატებითი როუტები გადახდის წარმატებისა და წარუმატებლობისთვის
Route::get('/payment/success', function () {
    return view('payment.success');
})->name('payment.success');

Route::get('/payment/fail', function () {
    return view('payment.fail');
})->name('payment.fail');
