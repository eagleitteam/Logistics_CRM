<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trip_date' => 'required|date',
            'vehicle_no' => 'required',
            'vendor_id' => 'nullable',
            'unique_no' => 'nullable',
            'vehicle_type_category' => 'nullable',
            'origin' => 'required',
            'destination' => 'required',
            'vehicle_type_id' => 'required',
            'client_id' => 'required',
            'driver_id' => 'required',
            'rate' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'trip_date.required' => 'Trip Date is required.',

            'vehicle_no.required' => 'Vehicle Number is required.',
            'origin.required' => 'Origin is required',
            'destination.required' => 'Destination is required',

            'vehicle_id.required' => 'Vehicle Type is required,',
            'client_id.required' => 'Client is required,',
            'driver_id.required' => 'Driver is required,',
            'rate.required' => 'Rate is required,',
        ];
    }
}
