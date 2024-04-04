<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
    Route::get('/', function () {
        // return redirect(route('login'));
        return view('app.welcome');
    })->name('tenant.home');

    Route::get('/tenant-dashboard', function () {
        return view('app.dashboard');
    })->middleware(['auth', 'verified'])->name('tenant.dashboard');
    require __DIR__ . '/tenant-auth.php';
});
