<?php

// app/Http/Requests/Admin/Masters/StoreInvoicemasterRequest.php
namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoicemasterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'inv_no' => 'required|string|max:255|unique:invoicemasters,inv_no',
            'inv_date' => 'nullable|date',
            'client_id' => 'required|exists:clientmasters,id',
            'trip_ids' => 'required|array|min:1',

            // optional fields
            'po_number' => 'nullable|string|max:255',
            'sac_no' => 'nullable|string|max:255',
            'termdays' => 'nullable',
            'transaction_nature' => 'nullable|string|max:255',
            'supply_nature' => 'nullable|string|max:255',
            'invoice_period' => 'nullable|string|max:255',
            'billed_from' => 'nullable|string|max:255',
            'billed_from_address' => 'nullable|string|max:255',
        ];
    }
}
