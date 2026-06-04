<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                       => $this->id,
            'name'                     => $this->name,
            'description'              => $this->description ?? 'Sin descripción',
            'duration'                 => $this->duration,
            'status'                   => $this->status,
            'administration_frequency' => $this->administration_frequency,
            'diagnosis_id'             => $this->diagnosis_id,
            'doctor_id'                => $this->doctor_id,
            // Carga condicional de relaciones (incluyendo los medicamentos si vienen cargados)
            'diagnosis'                => $this->whenLoaded('diagnosis'),
            'doctor'                   => $this->whenLoaded('doctor'),
            'medications'              => MedicationsResource::collection($this->whenLoaded('medications')),
        ];
    }
}