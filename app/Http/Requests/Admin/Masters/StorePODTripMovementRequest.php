<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StorePODTripMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pod_trip_id' => 'required|exists:trip_movements,id',
            'pod_no' => 'required|string',
            'pod_document' => 'nullable|file',

            // Auto-set values (not from user)
            'pod_status' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'pod_trip_id.required' => 'Trip Movement ID is missing.',
            'pod_trip_id.exists' => 'Invalid Trip Movement.',
            'pod_no.required' => 'POD Number is required.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'pod_status' => 1,
        ]);
    }
}
