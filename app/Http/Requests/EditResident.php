<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditResident extends FormRequest
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
           'res_name' => 'required|string|max:255',
        'email'    => 'required|email|max:255',
        'phone'    => 'required|string|max:20',
        'gender'   => 'required|in:male,female',
        'status'   => 'required|in:active,inactive',
        ];
    }
}
