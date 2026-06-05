@extends('layouts.app')

@section('content')

<h1 class="welcome-title">Bienvenido al Panel de Control</h1>
<p class="welcome-subtitle">Selecciona un módulo técnico para gestionar los datos del centro clínico.</p>

<div class="grid-modules">
    <!-- Pacientes -->
    <a href="/patients" class="module-box">
        <div class="icon-box">📁</div>
        <div class="module-info">
            <h3>Pacientes</h3>
            <p>Historial clínico y datos de contacto.</p>
        </div>
    </a>

    <!-- Médicos -->
    <a href="{{ route('doctors.index') }}" class="module-box">
        <div class="icon-box">🩺</div>
        <div class="module-info">
            <h3>Médicos</h3>
            <p>Especialidades y licencias activas.</p>
        </div>
    </a>

    <!-- Citas -->
    <a href="{{ route('appointments.index') }}" class="module-box">
        <div class="icon-box">📅</div>
        <div class="module-info">
            <h3>Citas Médicas</h3>
            <p>Control de turnos y salas.</p>
        </div>
    </a>

    <!-- Diagnósticos -->
    <a href="{{ route('diagnoses.index') }}" class="module-box">
        <div class="icon-box">📋</div>
        <div class="module-info">
            <h3>Diagnósticos</h3>
            <p>Evaluaciones y tipos de gravedad.</p>
        </div>
    </a>

    <!-- Tratamientos -->
    <a href="{{ route('treatments.index') }}" class="module-box">
        <div class="icon-box">💊</div>
        <div class="module-info">
            <h3>Tratamientos</h3>
            <p>Planes de recuperación y duraciones.</p>
        </div>
    </a>

    <!-- Medicamentos -->
    <a href="#" class="module-box">
        <div class="icon-box">📦</div>
        <div class="module-info">
            <h3>Medicamentos</h3>
            <p>Dosis, stock y proveedores.</p>
        </div>
    </a>
</div>

@endsection