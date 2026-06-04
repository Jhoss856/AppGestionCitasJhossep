<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'duration', 
        'diagnosis_id', 
        'doctor_id', 
        'status', 
        'administration_frequency'
    ];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }
}