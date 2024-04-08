<?php

namespace App\Http\Requests;

use App\Rules\UniqueDomain;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255','unique:users'],
            'company_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'domain' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9-_]+$/',
                'unique:domains,domain',new UniqueDomain
            ]
        ];
    }


    public function messages(): array
    {
        return [
            'domain.regex' => 'The :attribute may only contain letters, digits.',
            'email.unique' => 'Tenant is already registered with the given :attribute .',
        ];
    }
}
