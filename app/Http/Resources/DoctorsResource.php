<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'first_name'          => $this->first_name,
            'last_name'           => $this->last_name,
            'full_name'           => "{$this->first_name} {$this->last_name}",
            'specialty'           => $this->specialty,
            'phone'               => $this->phone ?? 'No asignado',
            'email'               => $this->email ?? 'No registrado',
            'license'             => $this->license,
            'years_of_experience' => $this->years_of_experience ?? 0,
        ];
    }
}