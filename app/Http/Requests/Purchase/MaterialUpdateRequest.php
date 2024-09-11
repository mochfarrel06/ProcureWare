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
        $materialId = $this->route('material');

        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:materials,code,' . $materialId],
            'description' => ['nullable', 'string'],
            'unit' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama material tidak boleh kosong',
            'code.required' => 'Kode material tidak boleh kosong',
            'code.unique' => 'Kode material sudah di tambahkan',
            'unit.required' => 'Satuan material tidak boleh kosong',
        ];
    }
}
