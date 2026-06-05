@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| appointments/edit.blade.php
| Formulario de edición de cita médica
|--------------------------------------------------------------------------
--}}

{{-- ── Page header ──────────────────────────────────────────────── --}}
<div class="page-header">
    <div class="page-header__left">
        <span class="page-eyebrow">Citas médicas · Editar</span>
        <h1 class="page-title">
            Cita
            <span class="mono" style="font-size:1rem; color:var(--text-3);">
                #{{ $appointment->id }}
            </span>
        </h1>
    </div>
    <div class="page-header__actions">
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver
        </a>
    </div>
</div>

{{-- ── Formulario ───────────────────────────────────────────────── --}}
<div class="card">
    <p class="card__title">Modificar datos de la cita</p>

    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <div class="form-group">
                <label class="form-label" for="ea_patient">Paciente</label>
                <select class="form-control" id="ea_patient" name="patient_id" required>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}"
                            {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->last_name }}, {{ $patient->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="ea_doctor">Médico especialista</label>
                <select class="form-control" id="ea_doctor" name="doctor_id" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                            Dr(a). {{ $doctor->last_name }}, {{ $doctor->first_name }}
                            ({{ $doctor->specialty }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="ea_date">Fecha y hora</label>
                <input class="form-control" type="datetime-local" id="ea_date"
                       name="appointment_date"
                       value="{{ date('Y-m-d\TH:i', strtotime($appointment->appointment_date)) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ea_room">Consultorio / Sala</label>
                <input class="form-control" type="text" id="ea_room"
                       name="room" value="{{ old('room', $appointment->room) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="ea_status">Estado de la cita</label>
                <select class="form-control" id="ea_status" name="status" required>
                    <option value="Pending"
                        {{ $appointment->status === 'Pending' ? 'selected' : '' }}>
                        Pendiente
                    </option>
                    <option value="Confirmed"
                        {{ $appointment->status === 'Confirmed' ? 'selected' : '' }}>
                        Confirmada
                    </option>
                    <option value="Canceled"
                        {{ $appointment->status === 'Canceled' ? 'selected' : '' }}>
                        Cancelada
                    </option>
                </select>
            </div>

            <div class="form-group span-2">
                <label class="form-label" for="ea_reason">Motivo de la consulta</label>
                <input class="form-control" type="text" id="ea_reason"
                       name="reason" value="{{ old('reason', $appointment->reason) }}" required>
            </div>

            <div class="form-group span-2">
                <label class="form-label" for="ea_notes">Notas clínicas</label>
                <textarea class="form-control" id="ea_notes" name="notes" rows="3">{{ old('notes', $appointment->notes) }}</textarea>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>

@endsection