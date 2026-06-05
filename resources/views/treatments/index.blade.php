@extends('layouts.app')

@section('content')
<div class="action-header">
    <h2 class="page-title">Gestión de Tratamientos</h2>
    <div>
        <a href="/home" class="btn-primary-custom" style="background-color: #64748b; margin-right: 10px; text-decoration: none; display: inline-flex; align-items: center;">Volver</a>
        <button class="btn-primary-custom" onclick="toggleFormPanel()">+ Nuevo Tratamiento</button>
    </div>
</div>

<div id="formPanel" class="form-card" style="display: none;">
    <h3 class="form-title">Registrar Nuevo Tratamiento</h3>
    <form action="{{ route('treatments.store') }}" method="POST">
        @csrf
        <div class="inputs-layout">
            <div class="input-block" style="grid-column: span 2;">
                <label>Nombre del Tratamiento</label>
                <input type="text" name="name" placeholder="Ej: Fisioterapia intensiva" required>
            </div>
            <div class="input-block" style="grid-column: span 2;">
                <label>Descripción</label>
                <textarea name="description" rows="2" placeholder="Detalles del plan de recuperación..." required></textarea>
            </div>
        </div>
        <div class="form-buttons">
            <button type="button" class="btn-action" style="background:#cbd5e1; color:#334155;" onclick="toggleFormPanel()">Cancelar</button>
            <button type="submit" class="btn-primary-custom">Guardar Datos</button>
        </div>
    </form>
</div>

<div class="table-container">
    <table class="modern-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones del Sistema</th>
            </tr>
        </thead>
        <tbody>
            @forelse($treatments as $treatment)
            <tr>
                <td><strong>#{{ $treatment->id }}</strong></td>
                <td>{{ $treatment->name }}</td>
                <td>{{ \Illuminate\Support\Str::limit($treatment->description, 50) }}</td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('treatments.edit', $treatment->id) }}" class="btn-action act-edit" style="text-decoration:none;">Editar</a>
                        <form action="{{ route('treatments.destroy', $treatment->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action act-delete" onclick="return confirm('¿Eliminar este tratamiento?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 30px;">No existen tratamientos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function toggleFormPanel() {
        var p = document.getElementById('formPanel');
        p.style.display = (p.style.display === 'none' || p.style.display === '') ? 'block' : 'none';
    }
</script>
@endsection