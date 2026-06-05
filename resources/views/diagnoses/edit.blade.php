@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| diagnoses/edit.blade.php
| Formulario de edición de diagnóstico clínico
|--------------------------------------------------------------------------
--}}

{{-- ── Page header ──────────────────────────────────────────────── --}}
<div class="page-header">
    <div class="page-header__left">
        <span class="page-eyebrow">Diagnósticos · Editar</span>
        <h1 class="page-title">
            Diagnóstico
            <span class="mono" style="font-size:1rem; color:var(--text-3);">
                #{{ $diagnosis->id }}
            </span>
        </h1>
    </div>
    <div class="page-header__actions">
        <a href="{{ route('diagnoses.index') }}" class="btn btn-secondary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver
        </a>
    </div>
</div>

{{-- ── Formulario ───────────────────────────────────────────────── --}}
<div class="card">
    <p class="card__title">Modificar datos del diagnóstico</p>

    <form action="{{ route('diagnoses.update', $diagnosis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label class="form-label" for="edg_patient">Paciente evaluado</label>
                <select class="form-control" id="edg_patient" name="patient_id" required>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}"
                            {{ $diagnosis->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->last_name }}, {{ $patient->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="edg_doctor">Médico especialista</label>
                <select class="form-control" id="edg_doctor" name="doctor_id" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            {{ $diagnosis->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->last_name }}, {{ $doctor->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="edg_date">Fecha y hora</label>
                <input class="form-control" type="datetime-local" id="edg_date"
                       name="date"
                       value="{{ date('Y-m-d\TH:i', strtotime($diagnosis->date)) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label" for="edg_type">Tipo de diagnóstico</label>
                <input class="form-control" type="text" id="edg_type"
                       name="diagnosis_type"
                       value="{{ old('diagnosis_type', $diagnosis->diagnosis_type) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label" for="edg_severity">Severidad</label>
                <select class="form-control" id="edg_severity" name="severity" required>
                    <option value="Mild"
                        {{ $diagnosis->severity === 'Mild' ? 'selected' : '' }}>
                        Leve (Mild)
                    </option>
                    <option value="Moderate"
                        {{ $diagnosis->severity === 'Moderate' ? 'selected' : '' }}>
                        Moderado (Moderate)
                    </option>
                    <option value="Severe"
                        {{ $diagnosis->severity === 'Severe' ? 'selected' : '' }}>
                        Grave (Severe)
                    </option>
                </select>
            </div>

            <div class="form-group span-2">
                <label class="form-label" for="edg_desc">Descripción / síntomas</label>
                <textarea class="form-control" id="edg_desc" name="description"
                          rows="3" required>{{ old('description', $diagnosis->description) }}</textarea>
            </div>

            <div class="form-group span-2">
                <label class="form-label" for="edg_rec">Recomendaciones clínicas</label>
                <textarea class="form-control" id="edg_rec" name="recommendations"
                          rows="2">{{ old('recommendations', $diagnosis->recommendations) }}</textarea>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('diagnoses.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>

@endsection