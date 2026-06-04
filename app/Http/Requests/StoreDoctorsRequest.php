<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'          => 'required|string|max:100',
            'last_name'           => 'required|string|max:100',
            'specialty'           => 'required|string|max:100',
            'phone'               => 'nullable|string|max:20',
            'email'               => 'nullable|email|max:150|unique:doctors,email',
            'license'             => 'required|string|max:50|unique:doctors,license',
            'years_of_experience' => 'nullable|integer',
        ];
    }
}