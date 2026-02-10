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
            'vehical_number' => 'required|integer|exists:driver_masters,id',
            'current_km' => 'required|integer',
            'fuel_qty' => 'required|numeric',
            'fuel_rate' => 'required|numeric',
            'driver_id' => 'required|integer|exists:driver_masters,id',
            'payment_method' => 'required|string|max:255',
            'distance' => 'required|integer',
            'fuel_amt' => 'required|numeric',
            'avg' => 'required|numeric',
            'note' => 'nullable|string',
        ];
    }
}
