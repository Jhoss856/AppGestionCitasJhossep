@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| diagnoses/index.blade.php
| Historial de diagnósticos clínicos
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
        <h1 class="page-title">Diagnósticos clínicos</h1>
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
            Emitir diagnóstico
        </button>
    </div>
</div>

{{-- ── Formulario colapsable ────────────────────────────────────── --}}
<div id="formPanel" class="form-panel">
    <div class="card" style="margin-bottom:0;">
        <p class="card__title">Registrar nuevo diagnóstico</p>

        <form action="{{ route('diagnoses.store') }}" method="POST">
            @csrf
            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label" for="dg_patient">Paciente evaluado</label>
                    <select class="form-control" id="dg_patient" name="patient_id" required>
                        <option value="">— Seleccione un paciente —</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">
                                {{ $patient->last_name }}, {{ $patient->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="dg_doctor">Médico evaluador</label>
                    <select class="form-control" id="dg_doctor" name="doctor_id" required>
                        <option value="">— Seleccione el especialista —</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->last_name }}, {{ $doctor->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="dg_date">Fecha y hora</label>
                    <input class="form-control" type="datetime-local"
                           id="dg_date" name="date" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="dg_type">Tipo de diagnóstico</label>
                    <input class="form-control" type="text" id="dg_type"
                           name="diagnosis_type" placeholder="Ej: General, Emergencia" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="dg_severity">Severidad</label>
                    <select class="form-control" id="dg_severity" name="severity" required>
                        <option value="Mild">Leve (Mild)</option>
                        <option value="Moderate">Moderado (Moderate)</option>
                        <option value="Severe">Grave (Severe)</option>
                    </select>
                </div>

                <div class="form-group span-2">
                    <label class="form-label" for="dg_desc">Descripción / síntomas detectados</label>
                    <textarea class="form-control" id="dg_desc" name="description"
                              rows="3" required></textarea>
                </div>

                <div class="form-group span-2">
                    <label class="form-label" for="dg_rec">Recomendaciones / tratamiento</label>
                    <textarea class="form-control" id="dg_rec" name="recommendations"
                              rows="2"></textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary"
                        onclick="togglePanel('formPanel')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar diagnóstico</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Tabla ─────────────────────────────────────────────────────── --}}
<div class="table-wrap">
    <table class="data-table" aria-label="Historial de diagnósticos">
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
                <td>
                    <span class="mono text-muted">#{{ $diag->id }}</span>
                </td>
                <td class="text-muted" style="font-size:0.82rem; white-space:nowrap;">
                    {{ \Carbon\Carbon::parse($diag->date)->format('d/m/Y') }}
                    <br>
                    <span style="font-size:0.75rem; color:var(--text-4);">
                        {{ \Carbon\Carbon::parse($diag->date)->format('H:i') }}
                    </span>
                </td>
                <td style="font-weight:500; color:var(--text-1);">
                    {{ $diag->patient->last_name }}, {{ $diag->patient->first_name }}
                </td>
                <td class="text-muted">Dr. {{ $diag->doctor->last_name }}</td>
                <td>
                    <span class="badge badge-slate">{{ $diag->diagnosis_type }}</span>
                </td>
                <td>
                    @if($diag->severity === 'Mild')
                        <span class="badge badge-green">Leve</span>
                    @elseif($diag->severity === 'Moderate')
                        <span class="badge badge-amber">Moderado</span>
                    @else
                        <span class="badge badge-red">Grave</span>
                    @endif
                </td>
                <td class="text-muted" style="max-width:160px; font-size:0.82rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ \Illuminate\Support\Str::limit($diag->description, 35) }}
                </td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('diagnoses.edit', $diag->id) }}"
                           class="btn btn-secondary" style="padding:5px 11px; font-size:0.78rem;">
                            Editar
                        </a>
                        <form action="{{ route('diagnoses.destroy', $diag->id) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    style="padding:5px 11px; font-size:0.78rem;"
                                    onclick="return confirm('¿Eliminar este diagnóstico de forma permanente?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="td-empty" colspan="8">
                    No hay diagnósticos registrados todavía.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection