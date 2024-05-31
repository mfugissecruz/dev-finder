<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User;
use App\Http\Middleware\DasboardCtoRestrictAccess;
use App\Livewire\Dashboard;
use App\Livewire\Favorites;
use App\Livewire\UserDefaultDashboard;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::middleware(Authenticate::class)->group(function () {
    Route::prefix('cto')->middleware(DasboardCtoRestrictAccess::class)->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('favorites', Favorites::class)->name('favorites');

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
    });

    Route::get('default/dashboard', UserDefaultDashboard::class)->name('default.dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
