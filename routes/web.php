<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login.view');
Route::post('/', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
