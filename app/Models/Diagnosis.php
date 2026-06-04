<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    // Forzamos el plural correcto en inglés para la tabla
    protected $table = 'diagnoses';

    protected $fillable = [
        'description', 
        'date', 
        'patient_id', 
        'doctor_id', 
        'severity', 
        'recommendations', 
        'diagnosis_type'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}