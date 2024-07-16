<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHouseRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'sqm' => 'required|integer|min:1',
            // 'latitude' => 'required|numeric',
            // 'longitude' => 'required|numeric',
            'image' => 'nullable|string|max:255',
            'visible' => 'boolean',
            
        ];
    }
}