<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect(route('tenant.dashboard'));
    }
}
