<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    // Expense fields list
    $expenseFields = [
        'trip_id',
        'toll_charges',
        'loading_unloading_charges',
        'handing_charges',
        'holding_charges',
        'holding_days',
        'other_exp',
        'total_exp',
    ];

    // Regex to allow numbers with up to 2 decimal places
    $numericRule = 'regex:/^\d+(\.\d{1,2})?$/';

    $rules = [];

    foreach ($expenseFields as $field) {
        $rules[$field] = [
            'nullable', // by default nullable
            $numericRule,
        ];
    }

    return $rules;
}

public function withValidator($validator)
{
    $validator->after(function ($validator) {
        $expenseFields = [
            'trip_id',
            'toll_charges',
            'loading_unloading_charges',
            'handing_charges',
            'holding_charges',
            'holding_days',
            'other_exp',
            'total_exp',
        ];

        // Check if any field is filled
        $anyFilled = false;
        foreach ($expenseFields as $field) {
            if (!empty($this->$field)) {
                $anyFilled = true;
                break;
            }
        }

        // If any field is filled, then require all
        if ($anyFilled) {
            foreach ($expenseFields as $field) {
                if (empty($this->$field)) {
                    $validator->errors()->add($field, ucfirst(str_replace('_', ' ', $field)) . ' is required.');
                }
            }
        }
    });
}

}
