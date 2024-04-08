<?php


use App\Http\Controllers\Tenant\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Tenant\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/tenant-login', [HomeController::class, 'index'])->name('tenant.index');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('tenant.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('tenant.logout');
});
