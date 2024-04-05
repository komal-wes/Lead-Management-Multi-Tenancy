<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantStoreRequest;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Stancl\Tenancy\Database\Models\Domain;

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
        $validatedData = $request->all();

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['tenant_url'] = preg_replace('/[^A-Za-z0-9]/', '', $validatedData['tenant_url']);
        $tenant = Tenant::create($validatedData);
        
        // Assigning domain to Tenant
        $tenant->domains()->create([
            'domain' => $validatedData['tenant_url'].'.'.config('app.domain')
        ]);
        return redirect()->route('dashboard');
    
    }
    public function tenantlogin($domain)
    {
        return redirect(tenant_route('tenant.directlogin', ['domain' => $domain, 'email' => Auth::user()->email]));
    }
}
