@extends('layouts.app')

@section('content')
<div class="action-header">
    <h2 class="page-title">Editar Paciente: {{ $doctors->first_name }} {{ $doctors->last_name }}</h2>
    <div>
        <a href="{{ route('doctors.index') }}" class="btn-primary-custom" style="background-color: #64748b; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Volver</a>
    </div>
</div>

<div class="form-card">
    <h3 class="form-title">Modificar Datos del Registro</h3>
    
    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="inputs-layout">
            <div class="input-block">
                <label>Nombre Completo</label>
                <input type="text" name="first_name" value="{{ $doctor->first_name }}" required>
            </div>
            <div class="input-block">
                <label>Apellidos</label>
                <input type="text" name="last_name" value="{{ $doctor->last_name }}" required>
            </div>
            <div class="input-block">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" value="{{ $doctor->date_of_birth }}" required>
            </div>
            <div class="input-block">
                <label>Género</label>
                <select name="gender">
                    <option value="Masculino" {{ $doctor->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ $doctor->gender == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>
            <div class="input-block">
                <label>Teléfono Móvil</label>
                <input type="text" name="phone" value="{{ $doctor->phone }}">
            </div>
            <div class="input-block">
                <label>Domicilio</label>
                <input type="text" name="address" value="{{ $doctor->address }}">
            </div>
            <div class="input-block">
                <label>Grupo Sanguíneo</label>
                <input type="text" name="blood_type" value="{{ $doctor->blood_type }}" placeholder="Ej: A+">
            </div>
        </div>

        <div class="form-buttons" style="margin-top: 20px;">
            <a href="{{ route('doctors.index') }}" class="btn-action" style="background:#cbd5e1; color:#334155; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Cancelar</a>
            <button type="submit" class="btn-primary-custom">Actualizar Datos</button>
        </div>
    </form>
</div>
@endsection