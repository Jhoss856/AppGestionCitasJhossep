<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'appointment_date' => $this->appointment_date,
            'reason'           => $this->reason,
            'status'           => $this->status,
            'notes'            => $this->notes,
            'room'             => $this->room,
            'patient'          => $this->whenLoaded('patient'),
            'doctor'           => $this->whenLoaded('doctor'),
        ];
    }
}