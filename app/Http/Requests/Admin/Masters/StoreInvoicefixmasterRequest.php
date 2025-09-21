<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoicefixmasterRequest extends FormRequest
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
            'clientmaster_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'contract_title' => 'required',
            'self_vehicle_id' => 'required',
            'vehical_type' => 'required',
            'fixed_km' => 'required',
            'fixed_price' => 'required',
            'extra_km_rate' => 'required',
        ];
    }
}
