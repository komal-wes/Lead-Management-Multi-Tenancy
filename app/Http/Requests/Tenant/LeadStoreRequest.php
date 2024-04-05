<?php

namespace App\Http\Requests\Tenant;

use App\Constants\Lead\SourceConstants;
use App\Constants\Lead\StatusConstants;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'client_name' => 'required|string|max:255',
            'lead_source' => [
                'required','in:' . implode(',', SourceConstants::getTypes()),
            ],
            'lead_date' => 'required|date',
            'job_title' => 'required|string|max:255',
            'description' => 'required',
            'status' => [
                'required','in:' . implode(',', StatusConstants::getTypes()),
            ],
            'priority' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ];
    }
}
