<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreNumberingprefixRequest extends FormRequest
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
            'year' => 'required',
            'type' => 'required',
            'prefix' => 'required',
            'digits' => 'required|numeric',
            'postfix' => 'required',
            'sampleFormat' => 'required',
            'status' => 'required|in:0,1',
        ];
    }
}
