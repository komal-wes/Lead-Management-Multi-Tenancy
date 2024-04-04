<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tenant = Tenant::where('email', Auth::user()->email)->first();
        return view('dashboard', ['tenant' => $tenant]);
    }
}
