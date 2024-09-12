<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryItemCreateRequest extends FormRequest
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
            'delivery_id' => 'required|exists:deliveries,id',
            'material_id' => 'required|exists:materials,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer',
            'condition' => 'required|in:good,damaged',
            'unique_code' => 'required|unique:delivery_items,unique_code',
            'storage_location' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'delivery_id' => 'Delivery tidak boleh kosong',
            'material_id' => 'material tidak boleh kosong',
            'supplier_id' => 'supplier Pembelian tidak boleh kosong',
            'quantity' => 'jumlah Pembelian tidak boleh kosong',
            'condition' => 'kondisi Pembelian tidak boleh kosong',
            'unique_code' => 'nomor tidak boleh kosong',
            'storage_location' => 'Lokasi tidak boleh kosong',
        ];
    }
}
