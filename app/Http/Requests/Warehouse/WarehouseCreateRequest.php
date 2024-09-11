<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseCreateRequest extends FormRequest
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
            'purchase_id' => ['required', 'exists:purchases,id'],
            'material_name' => ['required', 'string'],
            'material_code' => ['required', 'string'],
            'arrival_date' =>  ['required', 'date'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'quantity' => ['required', 'integer'],
            'storage_location' => ['required', 'string'],
            'condition' => ['required', 'in:good,bad'],
            'unique_number' => ['required', 'string', 'unique:warehouse_items,unique_number'],
        ];
    }

    public function messages()
    {
        return [
            'purchase_id.required' => 'Daftar Pembelian tidak boleh kosong',
            'material_name.required' => 'Nama material tidak boleh kosong',
            'material_code.required' => 'Kode material tidak boleh kosong',
            'arrival_date.required' => 'Kode material tidak boleh kosong',
            'supplier_id.required' => 'Supplier tidak boleh kosong',
            'quantity.required' => 'Jumlah tidak boleh kosong',
            'storage_location.required' => 'Jumlah tidak boleh kosong',
            'condition.required' => 'Jumlah tidak boleh kosong',
            'unique_number.required' => 'Nomor unik tidak boleh kosong',
            'unique_number.unique' => 'Nomor unik sudah di tambahkan',
        ];
    }
}
