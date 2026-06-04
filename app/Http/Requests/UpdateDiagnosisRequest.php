<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description'     => 'sometimes|required|string',
            'date'            => 'sometimes|required|date',
            'patient_id'      => 'sometimes|required|exists:patients,id',
            'doctor_id'       => 'sometimes|required|exists:doctors,id',
            'severity'        => 'sometimes|required|string|max:50',
            'recommendations' => 'nullable|string',
            'diagnosis_type'  => 'sometimes|required|string|max:100',
        ];
    }
}