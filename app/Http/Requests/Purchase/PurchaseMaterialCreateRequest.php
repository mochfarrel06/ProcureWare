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
            'expected_delivery_date' => ['required', 'date'],
            'total_price' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'purchase_request_id.required' => 'Permintaan pembelian tidak boleh kosong',
            'expected_delivery_date.required' => 'Tanggal Pengiriman Diharapkan tidak boleh kosong',
            'total_price.required' => 'Total harga tidak boleh kosong',
        ];
    }
}
