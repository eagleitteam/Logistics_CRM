<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripMovementRequest extends FormRequest
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
            'origin' => 'required',
            'destination' => 'required',
            'vehicle_id' => 'required',
            'client_id' => 'required',
            'driver_id' => 'required',
            'per_day_allow' => 'required',
            'rate' => 'required',
            'remark' => 'required',
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
            'per_day_allow.required' => 'Per Day Allowance is required,',
        ];
    }
}
