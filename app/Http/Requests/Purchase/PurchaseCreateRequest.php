<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseCreateRequest extends FormRequest
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
            'material_id' => ['required', 'exists:materials,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'quantity' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'material_id.required' => 'Material tidak boleh kosong',
            'supplier_id.required' => 'Supplier tidak boleh kosong',
            'quantity.required' => 'Jumlah pembelian tidak boleh kosong'
        ];
    }
}
