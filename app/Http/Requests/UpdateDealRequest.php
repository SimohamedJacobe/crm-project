<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDealRequest extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'stage' => ['required', 'string', Rule::in(['Lead', 'Qualified', 'Proposal', 'Won', 'Lost'])],
            'expected_close_date' => 'nullable|date',
        ];
    }
}
