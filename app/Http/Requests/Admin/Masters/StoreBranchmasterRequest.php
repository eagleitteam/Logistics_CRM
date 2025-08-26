<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchmasterRequest extends FormRequest
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
            'branch_code' => 'required|string|max:255|unique:branchmasters,branch_code',
            'branch_location' => 'required|string|max:255',
            'head_of_branch' => 'required|string|max:255',
            'remark' => 'nullable|string',

        ];
    }
}
