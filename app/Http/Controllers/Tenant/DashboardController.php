<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('app.welcome');
    }

    public function dashboard()
    {
        $user = Auth::user();
        tenancy()->central(function ($tenant) {
            $user = User::where('email', Auth::user()->email)->first();
        });
        $tenants = $user->tenants;
        return view('app.dashboard', ['tenants' => $tenants]);
    }
}
