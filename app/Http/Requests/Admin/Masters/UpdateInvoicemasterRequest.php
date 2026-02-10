<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoicemasterRequest extends FormRequest
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
            'invoice_number' => 'required|string|max:255|unique:invoicemasters,invoice_number,' . $this->route('invoicemaster')->id,
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:paid,unpaid,pending',
            'due_date' => 'nullable|date|after_or_equal:date',
            'notes' => 'nullable|string',
        ];
    }
}
