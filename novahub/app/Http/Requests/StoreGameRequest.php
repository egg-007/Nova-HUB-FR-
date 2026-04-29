<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'company';
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
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image:jpeg,png,jpg,webp|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',


            'requirements' => 'nullable|array|min:2',
            'requirements.*.type' => 'required|string',
            'requirements.*.os' => 'required|string',
            'requirements.*.cpu' => 'required|string',
            'requirements.*.gpu' => 'required|string',
            'requirements.*.ram' => 'required|string',
            'requirements.*.storage' => 'required|string',
        ];
    }
}
