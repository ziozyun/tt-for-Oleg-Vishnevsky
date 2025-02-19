<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'contacts' => 'required|array',
            'contacts.*.type' => 'required|in:Phone,Email',
            'contacts.*.value' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'contacts.*.type.in' => 'Тип контакту повинен бути або Телефон (1), або Email (2)',
            'contacts.*.value.email' => 'Значення контакту повинно бути коректною email адресою',
            'contacts.*.value.unique' => 'Цей контакт вже існує',
        ];
    }
}
