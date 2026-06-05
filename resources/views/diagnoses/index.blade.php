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
    <h2 class="page-title">Historial de Diagnósticos Clínicos</h2>
    <div>
        <a href="/home" class="btn-primary-custom" style="background-color: #64748b; margin-right: 10px; text-decoration: none; display: inline-flex; align-items: center;">Volver</a>
        <button class="btn-primary-custom" onclick="toggleFormPanel()">Emitir Diagnóstico</button>
    </div>
</div>

<div id="formPanel" class="form-card" style="display: none;">
    <h3 class="form-title">Registrar Nuevo Diagnóstico</h3>
    
    <form action="{{ route('diagnoses.store') }}" method="POST">
        @csrf
        <div class="inputs-layout">
            <div class="input-block">
                <label>Paciente Evaluado</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="">-- Seleccione un paciente --</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->last_name }}, {{ $patient->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Médico Evaluador</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="">-- Seleccione el especialista --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->last_name }}, {{ $doctor->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Fecha y Hora</label>
                <input type="datetime-local" name="date" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>

            <div class="input-block">
                <label>Tipo de Diagnóstico</label>
                <input type="text" name="diagnosis_type" placeholder="Ej: General, Control, Emergencia" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>

            <div class="input-block">
                <label>Severidad / Gravedad</label>
                <select name="severity" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="Mild">Mild (Leve)</option>
                    <option value="Moderate">Moderate (Moderado)</option>
                    <option value="Severe">Severe (Grave)</option>
                </select>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Descripción / Síntomas Detectados</label>
                <textarea name="description" rows="3" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-family: inherit;"></textarea>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Recomendaciones / Tratamiento</label>
                <textarea name="recommendations" rows="2" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-family: inherit;"></textarea>
            </div>
        </div>

        <div class="form-buttons" style="margin-top: 20px;">
            <button type="button" class="btn-action" onclick="toggleFormPanel()" style="background:#cbd5e1; color:#334155;">Cancelar</button>
            <button type="submit" class="btn-primary-custom" style="padding: 10px 25px;">Guardar Registro</button>
        </div>
    </form>
</div>

<div class="table-container" style="margin-top: 20px;">
    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Tipo</th>
                <th>Severidad</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($diagnoses as $diag)
            <tr>
                <td><strong>#{{ $diag->id }}</strong></td>
                <td>{{ date('d/m/Y H:i', strtotime($diag->date)) }}</td>
                <td>{{ $diag->patient->last_name }}, {{ $diag->patient->first_name }}</td>
                <td>Dr. {{ $diag->doctor->last_name }}</td>
                <td><span style="background:#f1f5f9; color:#475569; padding:3px 8px; border-radius:6px; font-size:0.85rem;">{{ $diag->diagnosis_type }}</span></td>
                <td>
                    @if($diag->severity == 'Mild')
                        <span style="background:#dcfce7; color:#15803d; padding:3px 10px; border-radius:12px; font-weight:600; font-size:0.8rem;">Leve</span>
                    @elseif($diag->severity == 'Moderate')
                        <span style="background:#fef9c3; color:#a16207; padding:3px 10px; border-radius:12px; font-weight:600; font-size:0.8rem;">Moderado</span>
                    @else
                        <span style="background:#fee2e2; color:#b91c1c; padding:3px 10px; border-radius:12px; font-weight:600; font-size:0.8rem;">Grave</span>
                    @endif
                </td>
                <td>{{ \Illuminate\Support\Str::limit($diag->description, 30) }}</td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('diagnoses.edit', $diag->id) }}" class="btn-action act-edit" style="text-decoration:none;">Editar</a>
                        <form action="{{ route('diagnoses.destroy', $diag->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action act-delete" onclick="return confirm('¿Eliminar de forma permanente este diagnóstico?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 30px;">No hay diagnósticos clínicos registrados todavía.</td>
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