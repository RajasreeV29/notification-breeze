<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
        'package_name' => 'required|string|max:255',
        'credits' => 'required|numeric|min:0', 
        'credit_due' => 'required|date', 
        'file_path' => 'required|file|mimes:jpg,png,pdf,jpeg|max:2048', 
        'status' => 'required|in:active,inactive',
    ];
    }
}
