<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Stancl\Tenancy\Database\Models\Domain;

class TenantStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'tenant_url' => [
                'required',
                'string',
                'max:255',
                'unique:domains,domain',
                function ($attribute, $value, $fail) {
                    $urlWithDomain = $value . '.' . config('app.domain');
                    if (Domain::where('domain', $urlWithDomain)->exists()) {
                        $fail('The domain already exists.');
                    }
                },
            ],
        ];
    }
}
