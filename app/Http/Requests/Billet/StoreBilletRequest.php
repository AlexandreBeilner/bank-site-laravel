<?php

namespace App\Http\Requests\Billet;

use Illuminate\Foundation\Http\FormRequest;

class StoreBilletRequest extends FormRequest
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
            'payer_name' => ['required', 'string', 'max:255'],
            'payer_document' => ['required', 'cpf_ou_cnpj'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'recipient_document' => ['required', 'cpf_ou_cnpj'],
            'amount' => ['required', 'numeric', 'between:0.00,9999999999999.99'],
            'expiration_date' => ['required', 'date'],
            'observations' => ['required', 'string', 'max:255'],
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
        ];
    }
}
