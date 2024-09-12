<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseReportCreateRequest extends FormRequest
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
            'purchase_id' => 'required|exists:purchases,id',
            'report_type' => 'required|string',
            'report_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'purchase_id.required' => 'tidak boleh kosong',
            'report_type.required' => 'Diharapkan tidak boleh kosong',
            'report_date.required' => 'tidak boleh kosong',
        ];
    }
}
