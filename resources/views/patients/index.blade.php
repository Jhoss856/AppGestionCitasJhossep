@extends('layouts.app')

@section('content')

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.showToast("{{ session('success') }}", 'success');
        });
    </script>
@endif

<div class="action-header">
    <h2 class="page-title">Gestión de Pacientes</h2>
    <div>
        <a href="/home" class="btn-primary-custom" style="background-color: #64748b; margin-right: 10px;">Volver</a>
        <button class="btn-primary-custom" onclick="toggleFormPanel()">Alternar Formulario</button>
    </div>
</div>

<div id="formPanel" class="form-card" style="display: none;">
    <h3 class="form-title">Inscribir Nuevo Paciente</h3>
    
    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div class="inputs-layout">
            <div class="input-block">
                <label>Nombre Completo</label>
                <input type="text" name="first_name" required>
            </div>
            <div class="input-block">
                <label>Apellidos</label>
                <input type="text" name="last_name" required>
            </div>
            <div class="input-block">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" required>
            </div>
            <div class="input-block">
                <label>Género</label>
                <select name="gender">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <div class="input-block">
                <label>Teléfono Móvil</label>
                <input type="text" name="phone">
            </div>
            <div class="input-block">
                <label>Domicilio</label>
                <input type="text" name="address">
            </div>
            <div class="input-block">
                <label>Grupo Sanguíneo</label>
                <input type="text" name="blood_type" placeholder="Ej: A+">
            </div>
        </div>

        <div class="form-buttons">
            <button type="button" class="btn-action" style="background:#cbd5e1; color:#334155;" onclick="toggleFormPanel()">Cancelar</button>
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
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn-action act-edit">Editar</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
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