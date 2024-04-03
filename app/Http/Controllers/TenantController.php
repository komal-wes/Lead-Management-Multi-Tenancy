<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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
        return view('tenants.index', compact('tenants'));
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tenant_url' => ['required', 'string','max:255', 'unique:domains,domain',function ($attribute, $value, $fail) {
                $urlWithDomain = $value . '.'. config('app.domain');
                if (Domain::where('domain', $urlWithDomain)->exists()) {
                    $fail('The domain already exists.');
                }
            },],
        ]);

        $validatedData['parent_user'] = Auth::user()->id;
        $validatedData['tenant_url'] = preg_replace('/[^A-Za-z0-9]/', '', $validatedData['tenant_url']);
        $tenant = Tenant::create($validatedData);
        
        // Assigning domain to Tenant
        $tenant->domains()->create([
            'domain' => $validatedData['tenant_url'].'.'.config('app.domain')
        ]);
        return redirect()->route('dashboard');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }

    public function tenantlogin($domain)
    {
        return redirect(tenant_route('tenant.directlogin', ['domain' => $domain, 'email' => Auth::user()->email]));
    }
}
