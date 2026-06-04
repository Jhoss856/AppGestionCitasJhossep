<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'description'      => $this->description,
            'date'             => $this->date,
            'severity'         => $this->severity,
            'recommendations'  => $this->recommendations ?? 'Ninguna',
            'diagnosis_type'   => $this->diagnosis_type,
            'patient_id'       => $this->patient_id,
            'doctor_id'        => $this->doctor_id,
            'patient'          => $this->whenLoaded('patient'),
            'doctor'           => $this->whenLoaded('doctor'),
        ];
    }
}