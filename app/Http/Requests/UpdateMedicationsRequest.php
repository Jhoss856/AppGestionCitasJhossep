<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicationsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'sometimes|required|string|max:150',
            'dosage'       => 'sometimes|required|string|max:100',
            'frequency'    => 'sometimes|required|string|max:100',
            'duration'     => 'sometimes|required|string|max:100',
            'treatment_id' => 'sometimes|required|exists:treatments,id',
            'supplier'     => 'nullable|string|max:150',
            'side_effects' => 'nullable|string|max:255',
        ];
    }
}