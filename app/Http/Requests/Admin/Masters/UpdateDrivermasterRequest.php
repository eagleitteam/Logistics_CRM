<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDrivermasterRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10|unique:drivermasters,mobile_no',
            'basic_salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
            'resigning_date' => 'nullable|date|after_or_equal:joining_date',
            'alternate_contact_no' => 'nullable|digits:10',
            'address' => 'required|string',
            'email' => 'nullable|email|unique:drivermasters,email',
            'city' => 'required|string|max:255',
            'pincode' => 'required|digits:6',
            'state' => 'required|exists:statemasters,id',
            'bank_name' => 'required|string|max:255',
            'bank_account_no' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:11',
            'upi_reference_name' => 'nullable|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'upi_number' => 'nullable|string|max:255',
            'aadhar_card_number' => 'required|unique:drivermasters,aadhar_card_number|string|max:12',
            'aadhar_card_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pan_card_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'driving_license_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'driving_license_validity' => 'nullable|date|after:today',
            'remark' => 'nullable|string',
            'categories' => 'required|string|max:255',
            'master_id' => 'nullable|exists:master_group_categories,id',
            'group_id' => 'nullable|exists:master_group_categories,id',
            'subgroup_id' => 'nullable|exists:master_group_categories,id',
            'status' => 'required|in:1,2', // 1=Active, 2=Inactive
        ];
    }
}
