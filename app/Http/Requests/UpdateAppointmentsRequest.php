<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'appointment_date' => 'sometimes|required|date',
            'reason'             => 'sometimes|required|string|max:255',
            'patient_id'         => 'sometimes|required|exists:patients,id',
            'doctor_id'          => 'sometimes|required|exists:doctors,id',
            'status'             => 'sometimes|required|string|max:50',
            'notes'              => 'nullable|string',
            'room'               => 'nullable|string|max:50',
        ];
    }
}