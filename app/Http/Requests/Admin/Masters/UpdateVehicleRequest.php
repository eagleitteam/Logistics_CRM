<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
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
            'vehicle_type_master_id ' => 'required',
            'fule_type' => 'required',
            'register_date' => 'required',
            'vehicle_number' => 'required',
            'chassis_num' => 'required',
            'eng_num' => 'required',
            'model_num' => 'required',
            'toll_stm' => 'required',
            'remark' => 'required',
        ];
    }
}