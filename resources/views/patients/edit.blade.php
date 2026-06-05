@extends('layouts.app')

@section('content')
<div class="action-header">
    <h2 class="page-title">Editar Paciente: {{ $patient->first_name }} {{ $patient->last_name }}</h2>
    <div>
        <a href="{{ route('patients.index') }}" class="btn-primary-custom" style="background-color: #64748b; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Volver</a>
    </div>
</div>

<div class="form-card">
    <h3 class="form-title">Modificar Datos del Registro</h3>
    
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="inputs-layout">
            <div class="input-block">
                <label>Nombre Completo</label>
                <input type="text" name="first_name" value="{{ $patient->first_name }}" required>
            </div>
            <div class="input-block">
                <label>Apellidos</label>
                <input type="text" name="last_name" value="{{ $patient->last_name }}" required>
            </div>
            <div class="input-block">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" value="{{ $patient->date_of_birth }}" required>
            </div>
            <div class="input-block">
                <label>Género</label>
                <select name="gender">
                    <option value="Masculino" {{ $patient->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ $patient->gender == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>
            <div class="input-block">
                <label>Teléfono Móvil</label>
                <input type="text" name="phone" value="{{ $patient->phone }}">
            </div>
            <div class="input-block">
                <label>Domicilio</label>
                <input type="text" name="address" value="{{ $patient->address }}">
            </div>
            <div class="input-block">
                <label>Grupo Sanguíneo</label>
                <input type="text" name="blood_type" value="{{ $patient->blood_type }}" placeholder="Ej: A+">
            </div>
        </div>

        <div class="form-buttons" style="margin-top: 20px;">
            <a href="{{ route('patients.index') }}" class="btn-action" style="background:#cbd5e1; color:#334155; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Cancelar</a>
            <button type="submit" class="btn-primary-custom">Actualizar Datos</button>
        </div>
    </form>
</div>
@endsection