@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| patients/index.blade.php
| Lista completa de pacientes + formulario de alta colapsable
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
        <h1 class="page-title">Pacientes</h1>
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
            Nuevo paciente
        </button>
    </div>
</div>

{{-- ── Formulario de alta colapsable ───────────────────────────── --}}
<div id="formPanel" class="form-panel">
    <div class="card" style="margin-bottom: 0;">
        <p class="card__title">Registrar nuevo paciente</p>

        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label" for="p_first_name">Nombre(s)</label>
                    <input class="form-control" type="text" id="p_first_name"
                           name="first_name" placeholder="Ej: Ana Lucía" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="p_last_name">Apellidos</label>
                    <input class="form-control" type="text" id="p_last_name"
                           name="last_name" placeholder="Ej: Ríos Vásquez" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="p_dob">Fecha de nacimiento</label>
                    <input class="form-control" type="date" id="p_dob"
                           name="date_of_birth" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="p_gender">Género</label>
                    <select class="form-control" id="p_gender" name="gender">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="p_phone">Teléfono</label>
                    <input class="form-control" type="text" id="p_phone"
                           name="phone" placeholder="Ej: 987 654 321">
                </div>

                <div class="form-group">
                    <label class="form-label" for="p_blood">Grupo sanguíneo</label>
                    <input class="form-control" type="text" id="p_blood"
                           name="blood_type" placeholder="Ej: O+">
                </div>

                <div class="form-group span-2">
                    <label class="form-label" for="p_address">Domicilio</label>
                    <input class="form-control" type="text" id="p_address"
                           name="address" placeholder="Av. Principal 123, Lima">
                </div>

            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary"
                        onclick="togglePanel('formPanel')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar paciente</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Tabla de pacientes ───────────────────────────────────────── --}}
<div class="table-wrap">
    <table class="data-table" aria-label="Lista de pacientes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Nacimiento</th>
                <th>Género</th>
                <th>Teléfono</th>
                <th>Domicilio</th>
                <th>Sangre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
            <tr>
                <td>
                    <span class="mono text-muted">#{{ $patient->id }}</span>
                </td>
                <td style="font-weight:500; color:var(--text-1);">
                    {{ $patient->first_name }} {{ $patient->last_name }}
                </td>
                <td class="text-muted">
                    {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}
                </td>
                <td class="text-muted">{{ $patient->gender }}</td>
                <td class="text-muted">
                    {{ $patient->phone ?? '—' }}
                </td>
                <td class="text-muted" style="max-width:160px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $patient->address ?? '—' }}
                </td>
                <td>
                    @if($patient->blood_type)
                        <span class="badge badge-red">{{ $patient->blood_type }}</span>
                    @else
                        <span class="text-faint">N/A</span>
                    @endif
                </td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('patients.edit', $patient->id) }}"
                           class="btn btn-secondary" style="padding:5px 11px; font-size:0.78rem;">
                            Editar
                        </a>
                        <form action="{{ route('patients.destroy', $patient->id) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    style="padding:5px 11px; font-size:0.78rem;"
                                    onclick="return confirm('¿Eliminar este paciente del sistema?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="td-empty" colspan="8">
                    No hay pacientes registrados todavía.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection