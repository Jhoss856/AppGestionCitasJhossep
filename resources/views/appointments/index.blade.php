@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| appointments/index.blade.php
| Gestión de citas médicas
|--------------------------------------------------------------------------
--}}

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.showToast("{{ session('success') }}", 'success');
        });
    </script>
@endif

{{-- ── Page header ──────────────────────────────────────────────── --}}
<div class="page-header">
    <div class="page-header__left">
        <span class="page-eyebrow">Módulo</span>
        <h1 class="page-title">Citas médicas</h1>
    </div>
    <div class="page-header__actions">
        <a href="/home" class="btn btn-secondary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Volver
        </a>
        <button class="btn btn-primary" onclick="togglePanel('formPanel')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Agendar cita
        </button>
    </div>
</div>

{{-- ── Formulario de alta ───────────────────────────────────────── --}}
<div id="formPanel" class="form-panel">
    <div class="card" style="margin-bottom:0;">
        <p class="card__title">Registrar nueva cita</p>

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label" for="a_patient">Paciente</label>
                    <select class="form-control" id="a_patient" name="patient_id" required>
                        <option value="">— Seleccione un paciente —</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">
                                {{ $patient->last_name }}, {{ $patient->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="a_doctor">Médico especialista</label>
                    <select class="form-control" id="a_doctor" name="doctor_id" required>
                        <option value="">— Seleccione un especialista —</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                Dr(a). {{ $doctor->last_name }}, {{ $doctor->first_name }}
                                ({{ $doctor->specialty }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="a_date">Fecha y hora</label>
                    <input class="form-control" type="datetime-local"
                           id="a_date" name="appointment_date" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="a_room">Consultorio / Sala</label>
                    <input class="form-control" type="text" id="a_room"
                           name="room" placeholder="Ej: Consultorio 304" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="a_status">Estado inicial</label>
                    <select class="form-control" id="a_status" name="status" required>
                        <option value="Pending">Pendiente</option>
                        <option value="Confirmed">Confirmada</option>
                        <option value="Canceled">Cancelada</option>
                    </select>
                </div>

                <div class="form-group span-2">
                    <label class="form-label" for="a_reason">Motivo de la consulta</label>
                    <input class="form-control" type="text" id="a_reason"
                           name="reason" placeholder="Ej: Control post-operatorio" required>
                </div>

                <div class="form-group span-2">
                    <label class="form-label" for="a_notes">Notas clínicas (opcional)</label>
                    <textarea class="form-control" id="a_notes" name="notes"
                              rows="2"
                              placeholder="Síntomas reportados o indicaciones previas..."></textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary"
                        onclick="togglePanel('formPanel')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cita</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Tabla de citas ───────────────────────────────────────────── --}}
<div class="table-wrap">
    <table class="data-table" aria-label="Lista de citas médicas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha y hora</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Sala</th>
                <th>Estado</th>
                <th>Motivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
            <tr>
                <td>
                    <span class="mono text-muted">#{{ $appointment->id }}</span>
                </td>
                <td class="text-muted" style="white-space:nowrap; font-size:0.82rem;">
                    @if($appointment->appointment_date)
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}
                        <br>
                        <span style="font-size:0.75rem; color:var(--text-4);">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}
                        </span>
                    @else
                        <span class="text-faint">Sin fecha</span>
                    @endif
                </td>
                <td style="font-weight:500; color:var(--text-1);">
                    {{ $appointment->patient?->first_name ?? 'Paciente' }}
                    {{ $appointment->patient?->last_name ?? 'no encontrado' }}
                </td>
                <td class="text-muted">
                    Dr(a). {{ $appointment->doctor?->last_name ?? '—' }}
                </td>
                <td>
                    <span class="badge badge-slate">
                        {{ $appointment->room ?? 'N/A' }}
                    </span>
                </td>
                <td>
                    @if($appointment->status === 'Pending')
                        <span class="badge badge-amber">Pendiente</span>
                    @elseif($appointment->status === 'Confirmed')
                        <span class="badge badge-green">Confirmada</span>
                    @else
                        <span class="badge badge-red">Cancelada</span>
                    @endif
                </td>
                <td class="text-muted" style="max-width:140px; font-size:0.82rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $appointment->reason ?? '—' }}
                </td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('appointments.edit', $appointment->id) }}"
                           class="btn btn-secondary" style="padding:5px 11px; font-size:0.78rem;">
                            Editar
                        </a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    style="padding:5px 11px; font-size:0.78rem;"
                                    onclick="return confirm('¿Eliminar esta cita del sistema?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="td-empty" colspan="8">
                    No hay citas registradas todavía.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection