<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankmasterRequest extends FormRequest
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
            'act_type' => 'required|integer|between:1,3',
            'Bank_Name' => 'required|string|max:255',
            'BankBranch' => 'required|string|max:255',
            'BankAccountNo' => 'required|string|unique:bankmasters,BankAccountNo',
            'BankIFSCCode' => 'required|string|max:255',
            'Remark' => 'nullable|string',
            'year_master' => 'required|integer|exists:Yearmasters,id',
            'opening_amt' => 'required|numeric',
            'dr_cr' => 'required|integer|between:1,2',
        ];
    }
}
