<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir que se ejecute la validación
    }

    public function rules(): array
    {
        return [
            'first_name'    => 'sometimes|required|string|max:100',
            'last_name'     => 'sometimes|required|string|max:100',
            'date_of_birth' => 'sometimes|required|date',
            'gender'        => 'nullable|string|max:20',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'blood_type'    => 'nullable|string|max:10',
        ];
    }
}