<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVendormasterRequest extends FormRequest
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
            'vendor_name' => 'required|string|max:255',
            'vendor_address' => 'required|string|max:500', // 👈 FIXED
            'gst_status' => 'required|boolean',
            'gst_no' => 'required|required_with:gst_status|string|max:16',
            'tds_applicable' => 'required|boolean',
            'tds_rate' => 'required|integer',
            'contact_name' => 'required|string|max:255',
            'contact_no' => 'required|integer',
            'alternate_contact_no' => 'nullable|integer',
            'email' => 'required|email|max:50',
            'city' => 'required|string|max:50',
            'pincode' => 'required|integer',
            'state' => 'required|integer',
            'categories' => 'required|integer|max:191',
            'master_id' => 'required_if:categories,3|exists:master_groups,id',
            'group_id' => 'nullable|required_if:categories,2|exists:master_group_categories,id',
            'subgroup_id' => 'nullable|required_if:categories,1|exists:sub_group_masters,id',            'opening_amt' => 'nullable|numeric',
            'opening_amt' => 'nullable|numeric',
            'dr_cr' => 'nullable|required_with:opening_amt|in:1,2',
            // 'year_master' => 'nullable|required_with:opening_amt|integer|max:10',
            // 'year_master' => 'nullable|required_with:opening_amt|integer|max:10',
        ];
    }
}
