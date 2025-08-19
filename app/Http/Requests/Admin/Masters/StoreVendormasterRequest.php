<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendormasterRequest extends FormRequest
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
            'vendor_address' => 'required|text',
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
            'master_group_Category' => 'required|tinyInteger',
            'master_id' => 'required|string',
            'group_id' => 'required|string',
            'subgroup_id' => 'required|string|max:100',
            'opening_amt' => 'nullable|numeric',
            'dr_cr' => 'nullable|required_with:opening_amt|in:0,1',
            'year_master' => 'nullable|required_with:opening_amt|tinyInteger',
            'status' => 'required|in:1,2',
        ];
    }
}
