@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| patients/edit.blade.php
| Formulario de edición de paciente
|--------------------------------------------------------------------------
--}}

{{-- ── Page header ──────────────────────────────────────────────── --}}
<div class="page-header">
    <div class="page-header__left">
        <span class="page-eyebrow">Pacientes · Editar</span>
        <h1 class="page-title">
            {{ $patient->first_name }} {{ $patient->last_name }}
        </h1>
    </div>
    <div class="page-header__actions">
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">
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
    <p class="card__title">Modificar datos del paciente</p>

    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label class="form-label" for="ep_first_name">Nombre(s)</label>
                <input class="form-control" type="text" id="ep_first_name"
                       name="first_name" value="{{ old('first_name', $patient->first_name) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ep_last_name">Apellidos</label>
                <input class="form-control" type="text" id="ep_last_name"
                       name="last_name" value="{{ old('last_name', $patient->last_name) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ep_dob">Fecha de nacimiento</label>
                <input class="form-control" type="date" id="ep_dob"
                       name="date_of_birth"
                       value="{{ old('date_of_birth', $patient->date_of_birth) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ep_gender">Género</label>
                <select class="form-control" id="ep_gender" name="gender">
                    <option value="Masculino"
                        {{ old('gender', $patient->gender) === 'Masculino' ? 'selected' : '' }}>
                        Masculino
                    </option>
                    <option value="Femenino"
                        {{ old('gender', $patient->gender) === 'Femenino' ? 'selected' : '' }}>
                        Femenino
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="ep_phone">Teléfono</label>
                <input class="form-control" type="text" id="ep_phone"
                       name="phone" value="{{ old('phone', $patient->phone) }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="ep_blood">Grupo sanguíneo</label>
                <input class="form-control" type="text" id="ep_blood"
                       name="blood_type" value="{{ old('blood_type', $patient->blood_type) }}"
                       placeholder="Ej: A+">
            </div>

            <div class="form-group span-2">
                <label class="form-label" for="ep_address">Domicilio</label>
                <input class="form-control" type="text" id="ep_address"
                       name="address" value="{{ old('address', $patient->address) }}">
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>

@endsection