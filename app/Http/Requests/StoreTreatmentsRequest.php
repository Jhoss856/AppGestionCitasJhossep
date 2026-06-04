<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                     => 'required|string|max:150',
            'description'              => 'nullable|string',
            'duration'                 => 'required|string|max:100',
            'diagnosis_id'             => 'required|exists:diagnoses,id',
            'doctor_id'                => 'required|exists:doctors,id',
            'status'                   => 'required|string|max:50',
            'administration_frequency' => 'required|string|max:100',
        ];
    }
}