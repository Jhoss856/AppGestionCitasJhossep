<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'appointment_date' => 'required|date',
            'reason'             => 'required|string|max:255',
            'patient_id'         => 'required|exists:patients,id',
            'doctor_id'          => 'required|exists:doctors,id',
            'status'             => 'required|string|max:50',
            'notes'              => 'nullable|string',
            'room'               => 'nullable|string|max:50',
        ];
    }
}