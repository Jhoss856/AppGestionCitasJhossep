<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description'     => 'required|string',
            'date'            => 'required|date',
            'patient_id'      => 'required|exists:patients,id',
            'doctor_id'       => 'required|exists:doctors,id',
            'severity'        => 'required|string|max:50',
            'recommendations' => 'nullable|string',
            'diagnosis_type'  => 'required|string|max:100',
        ];
    }
}