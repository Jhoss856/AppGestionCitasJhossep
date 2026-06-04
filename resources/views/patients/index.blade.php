@extends('layouts.app')

@section('content')

<div class="action-header">
    <h2 class="page-title">Gestión de Pacientes</h2>
    <div>
    <a href="/home" class="btn-primary-custom" style="background-color: #64748b; margin-right: 10px;">Volver</a>
        <button class="btn-primary-custom" onclick="toggleFormPanel()">Alternar Formulario</button>
    </div>
</div>

<div id="formPanel" class="form-card" style="{{ isset($editPatient) ? 'display: block;' : 'display: none;' }}">
    <h3 class="form-title">
        {{ isset($editPatient) ? 'Modificar Registro del Paciente' : 'Inscribir Nuevo Paciente' }}
    </h3>
    
    <form action="{{ isset($editPatient) ? route('patients.update', $editPatient->id) : route('patients.store') }}" method="POST">
        @csrf
        @if(isset($editPatient)) @method('PUT') @endif

        <div class="inputs-layout">
            <div class="input-block">
                <label>Nombre Completo</label>
                <input type="text" name="first_name" value="{{ $editPatient->first_name ?? '' }}" required>
            </div>
            <div class="input-block">
                <label>Apellidos</label>
                <input type="text" name="last_name" value="{{ $editPatient->last_name ?? '' }}" required>
            </div>
            <div class="input-block">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" value="{{ $editPatient->date_of_birth ?? '' }}" required>
            </div>
            <div class="input-block">
                <label>Género</label>
                <select name="gender">
                    <option value="Masculino" {{ (isset($editPatient) && $editPatient->gender == 'Masculino') ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ (isset($editPatient) && $editPatient->gender == 'Femenino') ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>
            <div class="input-block">
                <label>Teléfono Móvil</label>
                <input type="text" name="phone" value="{{ $editPatient->phone ?? '' }}">
            </div>
            <div class="input-block">
                <label>Domicilio</label>
                <input type="text" name="address" value="{{ $editPatient->address ?? '' }}">
            </div>
            <div class="input-block">
                <label>Grupo Sanguíneo</label>
                <input type="text" name="blood_type" value="{{ $editPatient->blood_type ?? '' }}" placeholder="Ej: A+">
            </div>
        </div>

        <div class="form-buttons">
            <button type="button" class="btn-action" style="background:#cbd5e1; color:#334155;" onclick="toggleFormPanel()">Cerrar</button>
            <button type="submit" class="btn-primary-custom">Procesar Datos</button>
        </div>
    </form>
</div>

<div class="table-container">
    <table class="modern-table">
        <thead>
            <tr>
                <th>Código ID</th>
                <th>Paciente</th>
                <th>F. Nacimiento</th>
                <th>Género</th>
                <th>Contacto</th>
                <th>Dirección</th>
                <th>Sangre</th>
                <th>Acciones del Sistema</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
            <tr>
                <td><strong>#{{ $patient->id }}</strong></td>
                <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                <td>{{ $patient->date_of_birth }}</td>
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->phone ?? 'Sin número' }}</td>
                <td>{{ $patient->address ?? 'No registrada' }}</td>
                <td><span class="badge-blood">{{ $patient->blood_type ?? 'N/A' }}</span></td>
                <td>
                    <div class="row-actions">
                        <a href="/patients/{{ $patient->id }}/edit" class="btn-action act-edit">Editar</a>
                        <form action="/patients/{{ $patient->id }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action act-delete" onclick="return confirm('¿Retirar este registro del sistema?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 30px;">La base de datos se encuentra vacía.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function toggleFormPanel() {
        var panel = document.getElementById('formPanel');
        panel.style.display = (panel.style.display === 'none' || panel.style.display === '') ? 'block' : 'none';
    }
</script>
@endsection