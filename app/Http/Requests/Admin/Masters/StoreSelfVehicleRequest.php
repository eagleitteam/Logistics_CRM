<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreSelfVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type'           => 'required|in:1,2',
            'vehicle_number' => 'required|string|max:255',
        ];

        // Self vehicle rules
        if ($this->input('type') == 1) {
            $rules = array_merge($rules, [
                'vehicle_type_master_id' => 'required',
                'fule_type'              => 'required',
                'register_date'          => 'required|date',
                'chassis_num'            => 'required',
                'eng_num'                => 'required',
                'model_num'              => 'required',
                'toll_stm'               => 'required',
                'remark'                 => 'required',
            ]);
        }

        // Vendor vehicle rules
        if ($this->input('type') == 2) {
            $rules = array_merge($rules, [
                'vendor_name' => 'required|string|max:255',
                'capacity'    => 'required|numeric',
                'status'      => 'required|in:1,2,3',
            ]);
        }

       // 🔹 Documents tab rules (all-or-nothing)
        foreach ($this->input('documents', []) as $docId => $doc) {
            $hasAnyField = !empty($doc['start_date']) || !empty($doc['end_date']) || !empty($doc['file']);
            if ($hasAnyField) {
                $rules["documents.$docId.start_date"] = 'required|date';
                $rules["documents.$docId.end_date"]   = 'required|date|after:documents.' . $docId . '.start_date';
                $rules["documents.$docId.file"]       = 'required|mimes:pdf|max:2048';
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'type.required'                => 'Please select Type',
            'vehicle_number.required'      => 'Vehicle number is required',

            // Self errors
            'vehicle_type_master_id.required' => 'Please select vehicle type',
            'fule_type.required'              => 'Please select fuel type',
            'register_date.required'          => 'Register date is required',
            'chassis_num.required'            => 'Chassis number is required',
            'eng_num.required'                => 'Engine number is required',
            'model_num.required'              => 'Model number is required',
            'toll_stm.required'               => 'Toll STM link is required',
            'remark.required'                 => 'Remark is required',

            // Vendor errors
            'vendor_name.required' => 'Vendor name is required',
            'capacity.required'    => 'Capacity is required',
            'status.required'      => 'Please select status',

            // Document errors (clean names)
            'start_date.required' => 'Start Date is required if you begin filling this document',
            'end_date.required'   => 'End Date is required if you begin filling this document',
            'end_date.after'      => 'End Date must be after Start Date',
            'file.required'       => 'Document file is required if you begin filling this document',
            'file.mimes'          => 'Document file must be a PDF',
            'file.max'            => 'Document file size must not exceed 2MB',
        ];
    }

     public function attributes(): array
    {
        return [
            'documents.*.start_date' => 'Start Date',
            'documents.*.end_date'   => 'End Date',
            'documents.*.file'       => 'Document File',
        ];
    }
}
