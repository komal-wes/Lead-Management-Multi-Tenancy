<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\LeadController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('tenant.home');
    Route::get('/tenant-dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('tenant.dashboard');

    Route::post('leads/update-lead/{lead}', [LeadController::class, 'updateLead'])->name('leads.updateLead');
    Route::resource('leads', LeadController::class);

    require __DIR__ . '/tenant-auth.php';
});
