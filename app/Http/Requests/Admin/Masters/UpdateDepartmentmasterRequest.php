<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentmasterRequest extends FormRequest
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
            'department_code' => 'required|string|max:255|unique:departmentmasters,department_code,',
            'department_name' => 'required|string|max:255|unique:departmentmasters,department_name,',
            'head_of_department' => 'required|string|max:255',
            'branch_locations' => 'required|integer|exists:branchmasters,id',
            'Remark' => 'nullable|string',
            'status' => 'required|integer|between:1,2',
        ];
    }
}
