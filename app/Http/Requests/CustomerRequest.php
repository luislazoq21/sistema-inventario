<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        $customer_id = $this->route('customer')?->id ?? null;

        return [
            'identity_id' => ['required', 'exists:identities,id'],
            'document_number' => [
                'required',
                'integer',
                Rule::unique('customers', 'document_number')->ignore($customer_id),
            ],
            'name' => ['required', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'max:255'],
            'phone' => ['nullable', 'max:255'],
        ];
    }
}
