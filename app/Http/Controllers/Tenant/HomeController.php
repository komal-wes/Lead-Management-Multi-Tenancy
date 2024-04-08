<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($email)
    {
        if(Auth::user())
        {
            return redirect(route('tenant.dashboard'));
        }
        $user =  User::where('email', $email)->first();
        if(!$user)
        {
            return redirect(route('tenant.login'));
        }
        Auth::login($user);
        return redirect(route('tenant.dashboard'));
    }
}
