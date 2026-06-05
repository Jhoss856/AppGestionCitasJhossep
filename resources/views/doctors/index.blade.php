@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| doctors/index.blade.php
| Lista de médicos + formulario de alta colapsable
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
        <h1 class="page-title">Médicos</h1>
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
            Nuevo médico
        </button>
    </div>
</div>

{{-- ── Formulario de alta ───────────────────────────────────────── --}}
<div id="formPanel" class="form-panel">
    <div class="card" style="margin-bottom:0;">
        <p class="card__title">Registrar nuevo médico</p>

        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label" for="d_first_name">Nombre(s)</label>
                    <input class="form-control" type="text" id="d_first_name"
                           name="first_name" placeholder="Ej: Carlos" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="d_last_name">Apellidos</label>
                    <input class="form-control" type="text" id="d_last_name"
                           name="last_name" placeholder="Ej: Mendoza Torres" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="d_specialty">Especialidad</label>
                    <input class="form-control" type="text" id="d_specialty"
                           name="specialty" placeholder="Ej: Cardiología" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="d_license">N° Licencia / CMP</label>
                    <input class="form-control" type="text" id="d_license"
                           name="license" placeholder="Ej: CMP-12345" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="d_exp">Años de experiencia</label>
                    <input class="form-control" type="number" id="d_exp"
                           name="years_of_experience" placeholder="Ej: 8" min="0">
                </div>

                <div class="form-group">
                    <label class="form-label" for="d_phone">Teléfono</label>
                    <input class="form-control" type="text" id="d_phone"
                           name="phone" placeholder="Ej: 987 654 321">
                </div>

                <div class="form-group span-2">
                    <label class="form-label" for="d_email">Correo electrónico</label>
                    <input class="form-control" type="email" id="d_email"
                           name="email" placeholder="doctor@clinica.com">
                </div>

            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary"
                        onclick="togglePanel('formPanel')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar médico</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Tabla de médicos ─────────────────────────────────────────── --}}
<div class="table-wrap">
    <table class="data-table" aria-label="Lista de médicos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>N° Licencia</th>
                <th>Experiencia</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($doctors as $doctor)
            <tr>
                <td>
                    <span class="mono text-muted">#{{ $doctor->id }}</span>
                </td>
                <td style="font-weight:500; color:var(--text-1);">
                    {{ $doctor->first_name }} {{ $doctor->last_name }}
                </td>
                <td>
                    <span class="badge badge-teal">{{ $doctor->specialty }}</span>
                </td>
                <td>
                    <span class="mono text-muted">{{ $doctor->license }}</span>
                </td>
                <td class="text-muted">
                    {{ $doctor->years_of_experience ?? '0' }} años
                </td>
                <td class="text-muted">{{ $doctor->phone ?? '—' }}</td>
                <td class="text-muted" style="font-size:0.8rem;">
                    {{ $doctor->email ?? '—' }}
                </td>
                <td>
                    <div class="row-actions">
                        <a href="{{ route('doctors.edit', $doctor->id) }}"
                           class="btn btn-secondary" style="padding:5px 11px; font-size:0.78rem;">
                            Editar
                        </a>
                        <form action="{{ route('doctors.destroy', $doctor->id) }}"
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    style="padding:5px 11px; font-size:0.78rem;"
                                    onclick="return confirm('¿Eliminar este médico del sistema?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td class="td-empty" colspan="8">
                    No hay médicos registrados todavía.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection