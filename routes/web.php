<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', User\IndexController::class)->name('index');

        Route::controller(User\CreateController::class)->group(function () {
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

        Route::controller(User\EditController::class)->group(function () {
            Route::get('{user}/edit', 'edit')->name('edit');
            Route::put('{user}/update', 'update')->name('update');
        });
    });

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
