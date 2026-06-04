<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicationsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:150',
            'dosage'       => 'required|string|max:100',
            'frequency'    => 'required|string|max:100',
            'duration'     => 'required|string|max:100',
            'treatment_id' => 'required|exists:treatments,id',
            'supplier'     => 'nullable|string|max:150',
            'side_effects' => 'nullable|string|max:255',
        ];
    }
}