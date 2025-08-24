<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientmasterRequest extends FormRequest
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
            'client_name' => 'required|unique:client_masters|string|max:191',
            'billing_address' => 'required|string|max:500', // text field, allow bigger size

            'gst_status' => 'required|in:0,1',
            'gst_no' => 'required_if:gst_status,1|string|size:15',

            'billing_type' => 'required|in:0,1',
            'billing_date' => 'required_if:billing_type,1|date',

            'contact_name' => 'required|string|max:191',
            'contact_no' => 'required|digits:10',
            'alternate_contact_no' => 'nullable|digits:10',

            'email' => 'required|email|max:191',
            'city' => 'required|string|max:191',
            'pincode' => 'required|digits_between:4,10',

            'state' => 'required|string|max:191',   // varchar in DB
            'statecode' => 'required|integer',      // if you keep it as integer

            'categories' => 'required|integer|max:191',
            'master_id' => 'required_if:categories,3|exists:master_groups,id',
            'group_id' => 'nullable|required_if:categories,2|exists:master_group_categories,id',
            'subgroup_id' => 'nullable|required_if:categories,1|exists:sub_group_masters,id',


            'opening_amt' => 'nullable|numeric',
            'dr_cr' => 'nullable|required_with:opening_amt|in:1,2',

            'year_master' => 'nullable|required_with:opening_amt|integer|max:10',
        ];
    }
}
