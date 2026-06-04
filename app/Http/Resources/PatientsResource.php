<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'full_name'     => "{$this->first_name} {$this->last_name}",
            'date_of_birth' => $this->date_of_birth,
            'gender'        => $this->gender ?? 'No especificado',
            'phone'         => $this->phone ?? 'Sin teléfono',
            'address'       => $this->address ?? 'Sin dirección',
            'blood_type'    => $this->blood_type ?? 'N/A',
        ];
    }
}