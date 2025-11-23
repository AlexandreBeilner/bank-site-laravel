<?php

namespace App\Http\Requests\Billing;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
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
            'description' => ['required', 'string', 'max:255'],
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],
            'bank_id' => [
                'required',
                'integer',
                'exists:banks,id',
            ],
            'total_amount' => ['required', 'numeric', 'between:0.00,9999999999999.99'],
            'installments' => ['required', 'integer', 'between:1,12'],
            'first_due_date' => ['required', 'date'],
            'periodicity' => ['required', 'string', 'in:monthly,weekly,daily']
        ];
    }
}
