<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtenemos el ID del médico en base al nombre del parámetro en la ruta de la API
        $doctorId = $this->route('doctor')?->id ?? $this->route('doctor');

        return [
            'first_name'          => 'sometimes|required|string|max:100',
            'last_name'           => 'sometimes|required|string|max:100',
            'specialty'           => 'sometimes|required|string|max:100',
            'phone'               => 'nullable|string|max:20',
            'email'               => 'nullable|email|max:150|unique:doctors,email,' . $doctorId,
            'license'             => 'sometimes|required|string|max:50|unique:doctors,license,' . $doctorId,
            'years_of_experience' => 'nullable|integer',
        ];
    }
}