<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantStoreRequest;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenants.index', [$tenants => 'tenants']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantStoreRequest $request)
    {
        $domain = preg_replace('/[^A-Za-z0-9]/', '', $request->domain) . '.' . config('app.domain');
        $tenant = Tenant::create(array_merge($request->all(), ['user_id' => Auth::user()->id, 'domain' => $domain]));
        $tenant->domains()->create(['domain' => $domain]);
        return redirect()->route('dashboard');
    }
    public function tenantlogin($domain)
    {
        return redirect(tenant_route('tenant.directlogin', ['domain' => $domain, 'email' => Auth::user()->email]));
    }
}
