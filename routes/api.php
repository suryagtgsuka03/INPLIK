<?php

use App\Http\Controllers\BerlanggananController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::post('/bayar', [PaymentController::class, 'create']);