@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| treatments/edit.blade.php
| Formulario de edición de tratamiento
|--------------------------------------------------------------------------
--}}

{{-- ── Page header ──────────────────────────────────────────────── --}}
<div class="page-header">
    <div class="page-header__left">
        <span class="page-eyebrow">Tratamientos · Editar</span>
        <h1 class="page-title">
            Tratamiento
            <span class="mono" style="font-size:1rem; color:var(--text-3);">
                #{{ $treatment->id }}
            </span>
        </h1>
    </div>
    <div class="page-header__actions">
        <a href="{{ route('treatments.index') }}" class="btn btn-secondary">
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
    <p class="card__title">Modificar datos del tratamiento</p>

    <form action="{{ route('treatments.update', $treatment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label class="form-label" for="etr_name">Nombre del tratamiento</label>
                <input class="form-control" type="text" id="etr_name"
                       name="name"
                       value="{{ old('name', $treatment->name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="etr_diagnosis">Diagnóstico asociado</label>
                <select class="form-control" id="etr_diagnosis" name="diagnosis_id" required>
                    @foreach($diagnoses as $diagnosis)
                        <option value="{{ $diagnosis->id }}"
                            {{ $treatment->diagnosis_id == $diagnosis->id ? 'selected' : '' }}>
                            #{{ $diagnosis->id }} —
                            {{ \Illuminate\Support\Str::limit($diagnosis->description, 40) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="etr_doctor">Médico responsable</label>
                <select class="form-control" id="etr_doctor" name="doctor_id" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            {{ $treatment->doctor_id == $doctor->id ? 'selected' : '' }}>
                            Dr. {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="etr_duration">Duración</label>
                <input class="form-control" type="text" id="etr_duration"
                       name="duration"
                       value="{{ old('duration', $treatment->duration) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="etr_freq">Frecuencia de administración</label>
                <input class="form-control" type="text" id="etr_freq"
                       name="administration_frequency"
                       value="{{ old('administration_frequency', $treatment->administration_frequency) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label" for="etr_status">Estado del tratamiento</label>
                <select class="form-control" id="etr_status" name="status" required>
                    <option value="Ongoing"
                        {{ $treatment->status === 'Ongoing' ? 'selected' : '' }}>
                        En curso (Ongoing)
                    </option>
                    <option value="Completed"
                        {{ $treatment->status === 'Completed' ? 'selected' : '' }}>
                        Completado (Completed)
                    </option>
                </select>
            </div>

            <div class="form-group span-2">
                <label class="form-label" for="etr_desc">Descripción / instrucciones</label>
                <textarea class="form-control" id="etr_desc" name="description"
                          rows="3">{{ old('description', $treatment->description) }}</textarea>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('treatments.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>

@endsection