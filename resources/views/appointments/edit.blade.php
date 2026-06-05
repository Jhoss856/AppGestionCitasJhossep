@extends('layouts.app')

@section('content')
<div class="action-header">
    <h2 class="page-title">Editar Cita Médica: #{{ $appointment->id }}</h2>
    <div>
        <a href="{{ route('appointments.index') }}" class="btn-primary-custom" style="background-color: #64748b; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Volver</a>
    </div>
</div>

<div class="form-card">
    <h3 class="form-title">Modificar Datos del Registro</h3>
    
    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="inputs-layout">
            <div class="input-block">
                <label>Paciente Asignado</label>
                <select name="patient_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->last_name }}, {{ $patient->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Médico Especialista</label>
                <select name="doctor_id" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                            Dr(a). {{ $doctor->last_name }}, {{ $doctor->first_name }} ({{ $doctor->specialty }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-block">
                <label>Fecha y Hora Programada</label>
                <input type="datetime-local" name="appointment_date" value="{{ date('Y-m-d\TH:i', strtotime($appointment->appointment_date)) }}" required>
            </div>

            <div class="input-block">
                <label>Consultorio / Sala</label>
                <input type="text" name="room" value="{{ $appointment->room }}" required>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Motivo de la Consulta</label>
                <input type="text" name="reason" value="{{ $appointment->reason }}" required>
            </div>

            <div class="input-block">
                <label>Estado de la Cita</label>
                <select name="status" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmada</option>
                    <option value="Canceled" {{ $appointment->status == 'Canceled' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>

            <div class="input-block" style="grid-column: span 2;">
                <label>Notas Clínicas</label>
                <textarea name="notes" rows="2" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-family: inherit;">{{ $appointment->notes }}</textarea>
            </div>
        </div>

        <div class="form-buttons" style="margin-top: 20px;">
            <a href="{{ route('appointments.index') }}" class="btn-action" style="background:#cbd5e1; color:#334155; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Cancelar</a>
            <button type="submit" class="btn-primary-custom">Actualizar Datos</button>
        </div>
    </form>
</div>
@endsection