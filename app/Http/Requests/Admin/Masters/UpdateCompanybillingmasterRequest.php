<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanybillingmasterRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'company_type' => 'required|string|max:255',
            'pan_number' => 'required|string|max:50',
            'gststatus' => 'required|in:1,2',
            'gstno' => 'nullable|string|max:15',
            'proprietor_name' => 'nullable|string|max:255',
            'revscharge' => 'required|in:1,2',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pin_code' => 'required|string|max:6',
            'contact_number' => 'required|string|max:10',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_seal' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'authorised_signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
