<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class SupplierCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:suppliers,code'],
            'contact' => ['required', 'string', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama supplier tidak boleh kosong',
            'code.required' => 'Kode supplier tidak boleh kosong',
            'code.unique' => 'Kode supplier sudah di tambahkan',
            'contact.required' => 'Kontak supplier tidak boleh kosong',
        ];
    }
}
