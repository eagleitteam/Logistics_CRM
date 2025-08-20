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
            'vendor_name' => 'required|string|max:191',
            'vendor_address' => 'required|string|max:500', // text field, allow bigger size

            'gst_status' => 'required|in:0,1',
            'gst_no' => 'required_if:gst_status,1|string|size:15',

            'tds_applicable' => 'required|in:0,1',
            'tds_rate' => 'required_if:tds_applicable,1|integer',

            'contact_name' => 'required|string|max:191',
            'contact_no' => 'required|digits_between:6,15',
            'alternate_contact_no' => 'nullable|digits_between:6,15',

            'email' => 'required|email|max:191',
            'city' => 'required|string|max:191',
            'pincode' => 'required|digits_between:4,10',

            'state' => 'required|string|max:191',   // varchar in DB
            'statecode' => 'required|integer',      // if you keep it as integer

            'master_group_Category' => 'required|integer|max:191',
            'master_id' => 'required_if:master_group_Category,3|integer|exists:master_groups,id',
            'group_id' => 'required_if:master_group_Category,2|integer|exists:master_group_categories,id',
            'subgroup_id' => 'required_if:master_group_Category,1|integer|exists:sub_group_masters,id',

            'opening_amt' => 'nullable|numeric',
            'dr_cr' => 'nullable|required_with:opening_amt|in:0,1',
            'year_master' => 'nullable|required_with:opening_amt|integer|max:10',
        ];
    }
}
