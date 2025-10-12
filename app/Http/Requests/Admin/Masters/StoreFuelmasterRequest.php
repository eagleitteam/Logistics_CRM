<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuelmasterRequest extends FormRequest
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
            'date' => 'required|date',
            'vehical_number' => 'required',
            'current_km' => 'required|integer',
            'fuel_qty' => 'required|numeric',
            'fuel_rate' => 'required|numeric',
            // 'driver_id' => 'required',
            'payment_method' => 'required|string|max:255',
            'distance' => 'nullable',
            'fuel_amt' => 'nullable',
            // 'avg' => 'required|numeric',
            'note' => 'nullable|string',
             'driver_name' => 'required|string|max:255'
        ];
    }
}
