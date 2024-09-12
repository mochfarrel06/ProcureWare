<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseMaterialCreateRequest extends FormRequest
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
            'purchase_request_id' => ['required', 'exists:purchase_requests,id'],
            'price_per_unit' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'purchase_request_id.required' => 'Permintaan pembelian tidak boleh kosong',
            'price_per_unit.required' => 'Harga satuan tidak boleh kosong',
        ];
    }
}
