<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Stancl\Tenancy\Database\Models\Domain;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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

        $user = User::where('email', $validatedData['email'])->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->first_name.' '.$request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        $tenant =  Tenant::where('email', $validatedData['email'])->first();
        if(!$tenant)
        {
            $validatedData['parent_user'] = Auth::user()->id;
            // We are creating Tenant here 
            $tenant = Tenant::create($validatedData);
        }
        $validatedData['tenant_url'] = preg_replace('/[^A-Za-z0-9]/', '', $validatedData['tenant_url']);
        // Assigning domain to Tenant
        $tenant->domains()->create([
            'domain' => $validatedData['tenant_url'].'.'.config('app.domain')
        ]);
        return redirect(RouteServiceProvider::HOME);
    }
}
