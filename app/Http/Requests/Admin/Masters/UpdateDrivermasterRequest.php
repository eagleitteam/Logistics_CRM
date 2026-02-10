<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDrivermasterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $driverId = $this->route('drivermaster')?->id ?? $this->edit_model_id;

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

            // ✅ Ignore current driver in unique checks
            'mobile_no' => [
                'required',
                'digits:10',
                Rule::unique('drivermasters', 'mobile_no')->ignore($driverId),
            ],
            'alternate_contact_no' => 'nullable|digits:10|different:mobile_no',

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('drivermasters', 'email')->ignore($driverId),
            ],

            'joining_date' => 'required|date',
            'resigning_date' => 'nullable',
            'basic_salary' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'state' => 'required|exists:statemasters,id',

            'bank_name' => 'required|string|max:100',
            'bank_branch' => 'required|string|max:100',
            'bank_account_no' => 'required|string|regex:/^[0-9]{9,20}$/',
            'ifsc_code' => 'required|string|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',

            'upi_reference_name' => 'nullable|string|max:255',
            'upi_number' => 'nullable|digits:10',

            // ✅ Aadhar also ignores current record
            'aadhar_card_number' => [
                'required',
                'string',
                'digits:12',
                Rule::unique('drivermasters', 'aadhar_card_number')->ignore($driverId),
            ],

            // ✅ Files optional on update
            'aadhar_card_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pan_card_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'driving_license_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'driving_license_validity' => 'nullable|date|after:today',

            'remark' => 'nullable|string|max:500',
            'categories' => 'required|string|max:255',
            'master_id' => 'nullable|exists:master_groups,id',
            'group_id' => 'nullable|exists:master_group_categories,id',
            'subgroup_id' => 'nullable|exists:sub_group_masters,id',
            'status' => 'required|in:1,2',
        ];
    }

    public function messages(): array
    {
        return [
            'mobile_no.unique' => 'This Mobile Number already exists.',
            'email.unique' => 'This Email is already taken.',
            'aadhar_card_number.unique' => 'This Aadhar Number is already registered.',

            'aadhar_card_path.mimes' => 'Aadhar must be a PDF or image.',
            'pan_card_path.mimes' => 'PAN must be a PDF or image.',
            'driving_license_path.mimes' => 'License must be a PDF or image.',
        ];
    }
}
