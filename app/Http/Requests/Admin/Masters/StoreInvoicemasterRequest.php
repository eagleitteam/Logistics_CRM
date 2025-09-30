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
            // Required fields
            // 'inv_no'        => 'required|string|max:255',
            'inv_date'      => 'required|date',
            'client_id'     => 'required|integer|exists:clientmasters,id',
            'month'         => 'nullable|string|max:2',   // 01–12 format
            'invoiceType'   => 'required|string|in:adhoc_invoice,regular_invoice', // example types
            'TripsList'     => 'required|array|min:1',
            'TripsList.*'   => 'required|string',

            // Optional fields
            'poNumber'           => 'nullable|string|max:255',
            'sac_no'             => 'nullable|string|max:255',
            'termdays'           => 'nullable|string|max:50',
            'transaction_nature' => 'nullable|string|max:255',
            'supply_nature'      => 'nullable|string|max:255',
            'invoicePeriod'      => 'nullable|string|max:255',
            'billedTo'           => 'nullable|string|max:255',
            'billedToAddress'    => 'nullable|string|max:500',
            'gstno'              => 'nullable|string|max:50',
            'billed_from'        => 'nullable|string|max:255',
            'billed_from_address'=> 'nullable|string|max:500',
        ];
    }
}
