<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'gender'        => 'nullable|string|max:20',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'blood_type'    => 'nullable|string|max:10',
        ];
    }
}