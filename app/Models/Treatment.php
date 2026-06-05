<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    // Activamos todas las columnas requeridas por su migración
    protected $fillable = [
        'name',
        'description',
        'duration',
        'diagnosis_id',
        'doctor_id',
        'status',
        'administration_frequency',
    ];

    // Relación limpia con el diagnóstico
    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }

    // Relación limpia con el médico asignado
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}