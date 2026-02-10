<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGstmasterRequest extends FormRequest
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
            'code_type' => 'required|string|max:255',
            'gst_code' => 'required|string|max:255',
            'code_description' => 'required|string|max:255',
            'igst' => 'required_if:code_type,1|numeric',
            'cgst' => 'required_if:code_type,2|numeric',
            'sgst' => 'required_if:code_type,2|numeric',
            'remark' => 'nullable|string',
        ];
    }
}
