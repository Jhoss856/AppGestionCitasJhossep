<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'dosage'       => $this->dosage,
            'frequency'    => $this->frequency,
            'duration'     => $this->duration,
            'supplier'     => $this->supplier ?? 'No especificado',
            'side_effects' => $this->side_effects ?? 'Ninguno reportado',
            'treatment_id' => $this->treatment_id,
            // Deja lista la relación por si necesitas cargar el tratamiento completo
            'treatment'    => $this->whenLoaded('treatment'),
        ];
    }
}