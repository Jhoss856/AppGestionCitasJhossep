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
    <h2 class="page-title">Gestión de Doctores</h2>
    <div>
        <a href="/home" class="btn-primary-custom" style="background-color: #64748b; margin-right: 10px; text-decoration: none; display: inline-flex; align-items: center;">Volver</a>
        <button class="btn-primary-custom" onclick="toggleFormPanel()">Alternar Formulario</button>
    </div>
</div>

<div id="formPanel" class="form-card" style="display: none;">
    <h3 class="form-title">Inscribir Nuevo Doctor</h3>
    
    <form action="{{ route('doctors.store') }}" method="POST">
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
                <label>Especialidad Médica</label>
                <input type="text" name="specialty" placeholder="Ej: Cardiología" required>
            </div>
            <div class="input-block">
                <label>N° Licencia / Colegiatura</label>
                <input type="text" name="license" placeholder="Ej: CMP-12345" required>
            </div>
            <div class="input-block">
                <label>Años de Experiencia</label>
                <input type="number" name="years_of_experience" placeholder="Ej: 5">
            </div>
            <div class="input-block">
                <label>Teléfono Móvil</label>
                <input type="text" name="phone">
            </div>
            <div class="input-block" style="grid-column: span 2;">
                <label>Correo Electrónico</label>
                <input type="email" name="email" placeholder="doctor@clinica.com">
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
                <th>Doctor</th>
                <th>Especialidad</th>
                <th>N° Licencia</th>
                <th>Experiencia</th>
                <th>Contacto</th>
                <th>Correo Electrónico</th>
                <th>Acciones del Sistema</th>
            </tr>
        </thead>
        <tbody>
            @forelse($doctors as $doctor)
            <tr>
                <td><strong>#{{ $doctor->id }}</strong></td>
                <td>{{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                <td><span style="background-color: rgba(20, 184, 166, 0.1); color: var(--teal); padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 0.85rem;">{{ $doctor->specialty }}</span></td>
                <td><code>{{ $doctor->license }}</code></td>
                <td>{{ $doctor->years_of_experience ?? '0' }} años</td>
                <td>{{ $doctor->phone ?? 'Sin número' }}</td>
                <td>{{ $doctor->email ?? 'No registrado' }}</td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn-action act-edit" style="text-decoration:none;">Editar</a>
                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action act-delete" onclick="return confirm('¿Retirar este registro del sistema?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 30px;">La base de datos de especialistas se encuentra vacía.</td>
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