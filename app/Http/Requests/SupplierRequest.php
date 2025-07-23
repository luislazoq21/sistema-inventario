<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
        $supplier_id = $this->route('supplier')?->id ?? null;

        return [
            'identity_id' => ['required', 'exists:identities,id'],
            'document_number' => [
                'required',
                'integer',
                Rule::unique('suppliers', 'document_number')->ignore($supplier_id),
            ],
            'name' => ['required', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'phone' => ['nullable', 'max:255'],
        ];
    }
}
