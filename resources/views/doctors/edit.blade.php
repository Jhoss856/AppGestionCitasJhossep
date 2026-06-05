@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| doctors/edit.blade.php
| Formulario de edición de médico
|--------------------------------------------------------------------------
--}}

{{-- ── Page header ──────────────────────────────────────────────── --}}
<div class="page-header">
    <div class="page-header__left">
        <span class="page-eyebrow">Médicos · Editar</span>
        <h1 class="page-title">
            {{ $doctor->first_name }} {{ $doctor->last_name }}
        </h1>
    </div>
    <div class="page-header__actions">
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">
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
    <p class="card__title">Modificar datos del médico</p>

    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label class="form-label" for="ed_first_name">Nombre(s)</label>
                <input class="form-control" type="text" id="ed_first_name"
                       name="first_name"
                       value="{{ old('first_name', $doctor->first_name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ed_last_name">Apellidos</label>
                <input class="form-control" type="text" id="ed_last_name"
                       name="last_name"
                       value="{{ old('last_name', $doctor->last_name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ed_dob">Fecha de nacimiento</label>
                <input class="form-control" type="date" id="ed_dob"
                       name="date_of_birth"
                       value="{{ old('date_of_birth', $doctor->date_of_birth) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ed_gender">Género</label>
                <select class="form-control" id="ed_gender" name="gender">
                    <option value="Masculino"
                        {{ old('gender', $doctor->gender) === 'Masculino' ? 'selected' : '' }}>
                        Masculino
                    </option>
                    <option value="Femenino"
                        {{ old('gender', $doctor->gender) === 'Femenino' ? 'selected' : '' }}>
                        Femenino
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="ed_phone">Teléfono</label>
                <input class="form-control" type="text" id="ed_phone"
                       name="phone"
                       value="{{ old('phone', $doctor->phone) }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="ed_blood">Grupo sanguíneo</label>
                <input class="form-control" type="text" id="ed_blood"
                       name="blood_type"
                       value="{{ old('blood_type', $doctor->blood_type) }}"
                       placeholder="Ej: A+">
            </div>

            <div class="form-group span-2">
                <label class="form-label" for="ed_address">Domicilio</label>
                <input class="form-control" type="text" id="ed_address"
                       name="address"
                       value="{{ old('address', $doctor->address) }}">
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>

@endsection