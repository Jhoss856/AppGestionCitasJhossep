@extends('layouts.app')

@section('content')
<div class="action-header">
    <h2 class="page-title">Editar Tratamiento: #{{ $treatment->id }}</h2>
    <div>
        <a href="{{ route('treatments.index') }}" class="btn-primary-custom" style="background-color: #64748b; text-decoration: none; display: inline-flex; align-items: center;">Volver</a>
    </div>
</div>

<div class="form-card">
    <h3 class="form-title">Modificar Detalles</h3>
    <form action="{{ route('treatments.update', $treatment->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="inputs-layout">
            <div class="input-block" style="grid-column: span 2;">
                <label>Nombre del Tratamiento</label>
                <input type="text" name="name" value="{{ $treatment->name }}" required>
            </div>
            <div class="input-block" style="grid-column: span 2;">
                <label>Descripción</label>
                <textarea name="description" rows="3" required>{{ $treatment->description }}</textarea>
            </div>
        </div>
        <div class="form-buttons" style="margin-top: 20px;">
            <a href="{{ route('treatments.index') }}" class="btn-action" style="background:#cbd5e1; color:#334155; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Cancelar</a>
            <button type="submit" class="btn-primary-custom">Actualizar Datos</button>
        </div>
    </form>
</div>
@endsection