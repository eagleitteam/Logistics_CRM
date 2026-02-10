<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreDrivermasterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10|unique:drivermasters,mobile_no',
            'alternate_contact_no' => 'nullable|digits:10|different:mobile_no',
            'email' => 'nullable|email|max:255|unique:drivermasters,email',
            'joining_date' => 'required|date',
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

            'aadhar_card_number' => 'required|string|digits:12|unique:drivermasters,aadhar_card_number',
            'aadhar_card_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pan_card_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'driving_license_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'driving_license_validity' => 'nullable|date|after:today',

            'remark' => 'nullable|string|max:500',
            'categories' => 'required|string|max:255',
            'master_id' => 'nullable|exists:master_groups,id',
            'group_id' => 'nullable|exists:master_group_categories,id',
            'subgroup_id' => 'nullable|exists:sub_group_masters,id',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',

            'mobile_no.required' => 'Mobile Number is required.',
            'mobile_no.digits' => 'Mobile Number must be 10 digits.',
            'mobile_no.unique' => 'This Mobile Number already exists.',

            'alternate_contact_no.digits' => 'Alternate Number must be 10 digits.',
            'alternate_contact_no.different' => 'Alternate Number must be different from Mobile Number.',

            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This Email is already taken.',

            'joining_date.required' => 'Joining Date is required.',
            'resigning_date.after_or_equal' => 'Resigning Date must be after or equal to Joining Date.',

            'basic_salary.required' => 'Basic Salary is required.',
            'basic_salary.numeric' => 'Basic Salary must be a number.',
            'basic_salary.min' => 'Basic Salary cannot be negative.',

            'address.required' => 'Address is required.',
            'city.required' => 'City is required.',
            'pincode.required' => 'PIN Code is required.',
            'pincode.digits' => 'PIN Code must be exactly 6 digits.',
            'state.required' => 'State selection is required.',
            'state.exists' => 'Selected state is invalid.',

            'bank_name.required' => 'Bank Name is required.',
            'bank_branch.required' => 'Bank Branch is required.',
            'bank_account_no.required' => 'Bank Account Number is required.',
            'bank_account_no.regex' => 'Bank A/C Number must be 9 to 20 digits.',
            'bank_ifsc_code.required' => 'IFSC Code is required.',
            'bank_ifsc_code.regex' => 'Invalid IFSC Code format.',

            'gpay_number.digits' => 'Gpay/PhonePe number must be 10 digits.',

            'aadhar_card_number.required' => 'Aadhar Card Number is required.',
            'aadhar_card_number.digits' => 'Aadhar Number must be 12 digits.',
            'aadhar_card_number.unique' => 'This Aadhar Number is already registered.',

            'aadhar_card_path.required' => 'Please upload Aadhar Card.',
            'aadhar_card_path.mimes' => 'Aadhar must be a PDF or image.',
            'aadhar_card_path.max' => 'Aadhar file size should not exceed 2MB.',

            'pan_card_path.required' => 'Please upload PAN Card.',
            'pan_card_path.mimes' => 'PAN must be a PDF or image.',
            'pan_card_path.max' => 'PAN file size should not exceed 2MB.',

            'driving_license_path.required' => 'Please upload Driving License.',
            'driving_license_path.mimes' => 'License must be a PDF or image.',
            'driving_license_path.max' => 'License file size should not exceed 2MB.',

            'driving_license_validity.after' => 'Driving License must be valid (after today).',

            'categories.required' => 'Category is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selected.',
        ];
    }
}
