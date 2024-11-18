<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('public/dashboard');
});

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
});

Route::get('/dashboard', function () {
  return view('public.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
