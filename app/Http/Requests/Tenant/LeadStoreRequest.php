<?php

namespace App\Http\Requests\Tenant;

use App\Models\Lead;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeadStoreRequest extends FormRequest
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
        $lead = new Lead();
        return [
            'client_name' => 'required|string|max:255',
            'lead_source' => [
                'required',Rule::in(array_keys($lead->lead_sources))
            ],
            'lead_date' => 'required|date',
            'job_title' => 'required|string|max:255',
            'description' => 'required',
            'status' => [
                'required',Rule::in(array_keys($lead->statuses))
            ],
            'priority' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ];
    }
}
