<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                     => 'sometimes|required|string|max:150',
            'description'              => 'nullable|string',
            'duration'                 => 'sometimes|required|string|max:100',
            'diagnosis_id'             => 'sometimes|required|exists:diagnoses,id',
            'doctor_id'                => 'sometimes|required|exists:doctors,id',
            'status'                   => 'sometimes|required|string|max:50',
            'administration_frequency' => 'sometimes|required|string|max:100',
        ];
    }
}