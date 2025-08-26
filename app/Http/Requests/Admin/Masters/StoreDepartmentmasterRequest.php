<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentmasterRequest extends FormRequest
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
            'department_code' => 'required|unique:departmentmasters,department_code|string|max:255',
            'department_name' => 'required|unique:departmentmasters,department_name|string|max:255',
            'head_of_department' => 'required|string|max:255',
            'branch_locations' => 'required|string|max:255',
            'Remark' => 'nullable|string',
        ];
    }
}
