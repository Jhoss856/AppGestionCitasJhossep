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
    <h2 class="page-title">Gestión de Citas Médicas</h2>
    <div>
        <a href="/home" class="btn-primary-custom" style="background-color: #64748b; margin-right: 10px; text-decoration: none; display: inline-flex; align-items: center;">Volver</a>
        <button class="btn-primary-custom" onclick="toggleFormPanel()">Agendar Nueva Cita</button>
    </div>
</div>

<div id="formPanel" class="form-card" style="display: none;">
    <h3 class="form-title">Inscribir Nueva Cita</h3>
    
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="inputs-layout">
            <div class="input-block">
                <label>Paciente Solicitante</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="">-- Seleccione un paciente --</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->last_name }}, {{ $patient->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Médico Especialista</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="">-- Seleccione un especialista --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr(a). {{ $doctor->last_name }}, {{ $doctor->first_name }} ({{ $doctor->specialty }})</option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Fecha y Hora Programada</label>
                <input type="datetime-local" name="appointment_date" required>
            </div>

            <div class="input-block">
                <label>Consultorio / Sala</label>
                <input type="text" name="room" placeholder="Ej: Consultorio 304" required>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Motivo de la Consulta</label>
                <input type="text" name="reason" placeholder="Ej: Control de rutina post operatorio" required>
            </div>

            <div class="input-block">
                <label>Estado Inicial</label>
                <select name="status" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="Pending">Pendiente</option>
                    <option value="Confirmed">Confirmada</option>
                    <option value="Canceled">Cancelada</option>
                </select>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Notas Clínicas Opcionales</label>
                <textarea name="notes" rows="2" placeholder="Síntomas reportados o indicaciones previas..." style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-family: inherit;"></textarea>
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
                <th>Fecha y Hora</th>
                <th>Paciente</th>
                <th>Médico Asignado</th>
                <th>Consultorio</th>
                <th>Estado</th>
                <th>Motivo</th>
                <th>Acciones del Sistema</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
            <tr>
                <td><strong>#{{ $appointment->id }}</strong></td>
                <td>{{ $appointment->appointment_date ? date('d/m/Y h:i A', strtotime($appointment->appointment_date)) : 'Sin fecha' }}</td>
                <td>
                    {{ $appointment->patient?->first_name ?? 'Paciente' }} 
                    {{ $appointment->patient?->last_name ?? 'No Registrado' }}
                </td>
                <td>Dr(a). {{ $appointment->doctor?->last_name ?? 'Sin Asignar' }}</td>
                <td><span style="background:#f1f5f9; padding: 4px 8px; border-radius:6px; font-size:0.85rem;">{{ $appointment->room ?? 'N/A' }}</span></td>
                <td>
                    @if($appointment->status == 'Pending')
                        <span style="background:#fef3c7; color:#d97706; padding:3px 10px; border-radius:12px; font-weight:600; font-size:0.8rem;">Pendiente</span>
                    @elseif($appointment->status == 'Confirmed')
                        <span style="background:#dcfce7; color:#15803d; padding:3px 10px; border-radius:12px; font-weight:600; font-size:0.8rem;">Confirmada</span>
                    @else
                        <span style="background:#fee2e2; color:#b91c1c; padding:3px 10px; border-radius:12px; font-weight:600; font-size:0.8rem;">Cancelada</span>
                    @endif
                </td>
                <td>{{ \Illuminate\Support\Str::limit($appointment->reason, 25) }}</td>                <td>
                    <div class="row-actions">
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn-action act-edit" style="text-decoration:none;">Editar</a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action act-delete" onclick="return confirm('¿Retirar este registro del sistema?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 30px;">La base de datos de citas se encuentra vacía.</td>
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