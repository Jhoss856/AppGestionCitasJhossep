@extends('layouts.app')

@section('content')
<div class="action-header">
    <h2 class="page-title">Editar Diagnóstico Clínico: #{{ $diagnosis->id }}</h2>
    <div>
        <a href="{{ route('diagnoses.index') }}" class="btn-primary-custom" style="background-color: #64748b; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Volver</a>
    </div>
</div>

<div class="form-card">
    <h3 class="form-title">Modificar Datos del Registro</h3>
    
    <form action="{{ route('diagnoses.update', $diagnosis->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="inputs-layout">
            <div class="input-block">
                <label>Paciente Evaluado</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $diagnosis->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->last_name }}, {{ $patient->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Médico Especialista</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $diagnosis->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->last_name }}, {{ $doctor->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Fecha y Hora</label>
                <input type="datetime-local" name="date" value="{{ date('Y-m-d\TH:i', strtotime($diagnosis->date)) }}" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>

            <div class="input-block">
                <label>Tipo de Diagnóstico</label>
                <input type="text" name="diagnosis_type" value="{{ $diagnosis->diagnosis_type }}" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>

            <div class="input-block">
                <label>Severidad</label>
                <select name="severity" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="Mild" {{ $diagnosis->severity == 'Mild' ? 'selected' : '' }}>Leve (Mild)</option>
                    <option value="Moderate" {{ $diagnosis->severity == 'Moderate' ? 'selected' : '' }}>Moderado (Moderate)</option>
                    <option value="Severe" {{ $diagnosis->severity == 'Severe' ? 'selected' : '' }}>Grave (Severe)</option>
                </select>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Descripción / Síntomas</label>
                <textarea name="description" rows="3" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-family: inherit;">{{ $diagnosis->description }}</textarea>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Recomendaciones Clínicas</label>
                <textarea name="recommendations" rows="2" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-family: inherit;">{{ $diagnosis->recommendations }}</textarea>
            </div>
        </div>

        <div class="form-buttons" style="margin-top: 20px;">
            <a href="{{ route('diagnoses.index') }}" class="btn-action" style="background:#cbd5e1; color:#334155; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Cancelar</a>
            <button type="submit" class="btn-primary-custom" style="padding: 10px 25px;">Actualizar Diagnóstico</button>
        </div>
    </form>
</div>
@endsection