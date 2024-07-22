<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
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
            'name' => ['nullable', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'phone_number' => ['nullable', 'numeric', 'starts_with:3,0'],
            'message' => ['required', 'max:1000']
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.min' => 'Il nome deve avere almeno 3 caratteri.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'L\'email deve essere un indirizzo email valido.',
            'phone_number.numeric' => 'Il numero di telefono deve essere un numero.',
            'phone_number.starts_with' => 'Il numero di telefono deve iniziare con 3 o 0.',
            'message.required' => 'Il campo messaggio è obbligatorio.',
            'message.max' => 'Il messaggio non può superare i 1000 caratteri.',
        ];
    }
}
