<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('public.');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [MovieController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('dashboard');
Route::middleware(['auth', 'Admin'])->group(function () {
  Route::get('/admin-dashboard', function () {
    return view('private.admin');
  })->name('admin.dashboard');

  Route::get('/admin-detail', function () {
    return view('private.detail');
  })->name('admin.detail');

  Route::get('/admin-input', function () {
    return view('private.input');
  })->name('admin.input');

  Route::post('/admin-input', [MovieController::class, 'store'])->name('movie.store');
  Route::get('/admin-detail', [MovieController::class, 'adminDetail'])->name('admin.detail');
  Route::post('/admin-edit/{id}', [MovieController::class, 'update'])->name('movie.update');
  Route::delete('/admin-delete/{id}', [MovieController::class, 'destroy'])->name('movie.delete');

  Route::get('/videos/{id}', [MovieController::class, 'dashboard'])
    ->middleware(['auth', 'check.status'])
    ->name('video.dashboard');
});


require __DIR__ . '/auth.php';