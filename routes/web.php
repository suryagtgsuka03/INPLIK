<?php

use App\Http\Controllers\BerlanggananController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('public.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

  // Rute untuk memperbarui nama dan email
  Route::put('/profile/update-name', [ProfileController::class, 'updateName'])->name('profile.updateName');
  
  // Rute untuk memperbarui password
  Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

  Route::get('/account-detail', function () {
    return view('private.akundetail');});
});



Route::post('/create-payment', [BerlanggananController::class, 'createPayment'])->name('create.payment');

Route::post('/update-payment-status', [BerlanggananController::class, 'updatePaymentStatus'])->name('update.payment.status');


Route::get('/berlangganan', [BerlanggananController::class, 'public'])->name('berlangganan.public');

Route::get('/', [MovieController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::middleware(['auth', 'Admin'])->group(function () {

  Route::get('/admin-dashboard', function () {
    return view('private.admin');
  })->name('admin.dashboard');

  Route::get('/admin-input', function () {
    return view('private.input');
  })->name('admin.input');

  Route::post('/admin-input', [MovieController::class, 'store'])->name('movie.store');
  Route::post('/admin-edit/{id}', [MovieController::class, 'update'])->name('movie.update');
  Route::delete('/admin-delete/{id}', [MovieController::class, 'destroy'])->name('movie.delete');

  // Route untuk berlangganan
  Route::get('/admin-berlangganan', [BerlanggananController::class, 'index'])->name('berlangganan.index');
  Route::post('/admin-berlangganan', [BerlanggananController::class, 'store'])->name('berlangganan.store');

  Route::put('/admin-berlangganan/{id}', [BerlanggananController::class, 'edit'])->name('berlangganan.edit');

  // Route delete untuk berlangganan
  Route::delete('/admin-berlangganan/delete/{id}', [BerlanggananController::class, 'delete'])->name('berlangganan.delete');


  Route::get('/admin-detail', [MovieController::class, 'adminDetail'])->name('admin.detail');
  Route::get('/movies', [MovieController::class, 'filterByGenre'])->name('movies.index');
  Route::get('/videos/{id}', [MovieController::class, 'dashboard'])
    ->middleware(['auth', 'check.status'])
    ->name('video.dashboard');
});


require __DIR__ . '/auth.php';