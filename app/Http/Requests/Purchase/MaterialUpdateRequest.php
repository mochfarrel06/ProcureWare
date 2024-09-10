<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUpdateRequest extends FormRequest
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
        $materialId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:materials,code,' . $materialId],
            'category' => ['required', 'string', 'min:0'],
            'stock' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama material tidak boleh kosong',
            'code.required' => 'Kode material tidak boleh kosong',
            'code.unique' => 'Kode material sudah di tambahkan',
            'category.required' => 'Kategori tidak boleh kosong',
            'stock.required' => 'Stok material tidak boleh kosong',
        ];
    }
}
