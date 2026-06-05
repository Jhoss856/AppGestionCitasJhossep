@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| treatments/index.blade.php
| Gestión de tratamientos médicos
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
        <h1 class="page-title">Tratamientos</h1>
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
            Nuevo tratamiento
        </button>
    </div>
</div>

{{-- ── Formulario colapsable ────────────────────────────────────── --}}
<div id="formPanel" class="form-panel">
    <div class="card" style="margin-bottom:0;">
        <p class="card__title">Registrar nuevo tratamiento</p>

        <form action="{{ route('treatments.store') }}" method="POST">
            @csrf
            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label" for="tr_name">Nombre del tratamiento</label>
                    <input class="form-control" type="text" id="tr_name"
                           name="name" placeholder="Ej: Fisioterapia lumbar" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tr_diagnosis">Diagnóstico asociado</label>
                    <select class="form-control" id="tr_diagnosis" name="diagnosis_id" required>
                        <option value="">— Seleccione el diagnóstico —</option>
                        @foreach($diagnoses as $diagnosis)
                            <option value="{{ $diagnosis->id }}">
                                #{{ $diagnosis->id }} —
                                {{ \Illuminate\Support\Str::limit($diagnosis->description, 40) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tr_doctor">Médico responsable</label>
                    <select class="form-control" id="tr_doctor" name="doctor_id" required>
                        <option value="">— Seleccione el médico —</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                Dr. {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tr_duration">Duración</label>
                    <input class="form-control" type="text" id="tr_duration"
                           name="duration" placeholder="Ej: 3 semanas, 2 meses" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tr_freq">Frecuencia de administración</label>
                    <input class="form-control" type="text" id="tr_freq"
                           name="administration_frequency"
                           placeholder="Ej: Cada 8 horas / Diario" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="tr_status">Estado</label>
                    <select class="form-control" id="tr_status" name="status" required>
                        <option value="Ongoing">En curso</option>
                        <option value="Completed">Completado</option>
                    </select>
                </div>

                <div class="form-group span-2">
                    <label class="form-label" for="tr_desc">Descripción / instrucciones</label>
                    <textarea class="form-control" id="tr_desc" name="description"
                              rows="3"
                              placeholder="Detalles específicos del tratamiento..."></textarea>
                </div>

            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary"
                        onclick="togglePanel('formPanel')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar tratamiento</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Tabla ─────────────────────────────────────────────────────── --}}
<div class="table-wrap">
    <table class="data-table" aria-label="Lista de tratamientos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tratamiento</th>
                <th>Diagnóstico</th>
                <th>Médico</th>
                <th>Duración</th>
                <th>Frecuencia</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($treatments as $treatment)
            <tr>
                <td>
                    <span class="mono text-muted">#{{ $treatment->id }}</span>
                </td>
                <td>
                    <span style="font-weight:500; color:var(--text-1); display:block;">
                        {{ $treatment->name }}
                    </span>
                    @if($treatment->description)
                        <span style="font-size:0.77rem; color:var(--text-4);">
                            {{ \Illuminate\Support\Str::limit($treatment->description, 35) }}
                        </span>
                    @endif
                </td>
                <td>
                    @if($treatment->diagnosis)
                        <span class="badge badge-slate">
                            #{{ $treatment->diagnosis_id }} —
                            {{ \Illuminate\Support\Str::limit($treatment->diagnosis->description, 22) }}
                        </span>
                    @else
                        <span class="badge badge-red">Sin vínculo</span>
                    @endif
                </td>
                <td class="text-muted">
                    @if($treatment->doctor)
                        Dr. {{ $treatment->doctor->name }}
                    @else
                        <span class="text-faint">No registrado</span>
                    @endif
                </td>
                <td class="text-muted" style="font-size:0.82rem;">
                    {{ $treatment->duration }}
                </td>
                <td class="text-muted" style="font-size:0.82rem;">
                    {{ $treatment->administration_frequency }}
                </td>
                <td>
                    @if($treatment->status === 'Completed')
                        <span class="badge badge-green">Completado</span>
                    @else
                        <span class="badge badge-amber">En curso</span>
                    @endif
                </td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('treatments.edit', $treatment->id) }}"
                           class="btn btn-secondary" style="padding:5px 11px; font-size:0.78rem;">
                            Editar
                        </a>
                        <form action="{{ route('treatments.destroy', $treatment->id) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    style="padding:5px 11px; font-size:0.78rem;"
                                    onclick="return confirm('¿Eliminar este tratamiento?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="td-empty" colspan="8">
                    No hay tratamientos registrados todavía.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection