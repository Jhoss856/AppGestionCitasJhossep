@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| home.blade.php — Panel de Control
| Layout: stats resumen + grid de módulos clínicos
|--------------------------------------------------------------------------
--}}

<div class="hm-wrapper">

    {{-- ─── Encabezado ──────────────────────────────────────────── --}}
    <div class="hm-header">
        <span class="hm-eyebrow">Panel de control</span>
        <h1 class="hm-title">Bienvenido de nuevo</h1>
        <p class="hm-subtitle">
            Selecciona un módulo para gestionar los datos del centro clínico.
        </p>
    </div>

    {{-- ─── Barra de estadísticas rápidas ──────────────────────── --}}
    <div class="hm-stats">

        <div class="hm-stat">
            <span class="hm-stat__number">124</span>
            <span class="hm-stat__label">Pacientes activos</span>
        </div>

        <div class="hm-stat">
            <span class="hm-stat__number">18</span>
            <span class="hm-stat__label">Citas hoy</span>
        </div>

        <div class="hm-stat">
            <span class="hm-stat__number">9</span>
            <span class="hm-stat__label">Médicos disponibles</span>
        </div>

        <div class="hm-stat">
            <span class="hm-stat__number">3</span>
            <span class="hm-stat__label">Urgencias pendientes</span>
        </div>

    </div>

    {{-- ─── Divisor ──────────────────────────────────────────────── --}}
    <hr class="hm-divider">

    {{-- ─── Módulos ──────────────────────────────────────────────── --}}
    <div class="hm-grid">

        {{-- 1. Pacientes --}}
        <a href="{{ route('patients.index') }}" class="hm-card">
            <span class="hm-card__icon hm-card__icon--blue">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.6"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
            </span>
            <div class="hm-card__body">
                <p class="hm-card__title">Pacientes</p>
                <p class="hm-card__desc">Historial clínico y datos de contacto</p>
            </div>
            <span class="hm-card__arrow" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </span>
        </a>

        {{-- 2. Médicos --}}
        <a href="{{ route('doctors.index') }}" class="hm-card">
            <span class="hm-card__icon hm-card__icon--green">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.6"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0z"/>
                    <path d="M14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0z"/>
                    <path d="M1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122z"/>
                    <path d="M17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003z"/>
                </svg>
            </span>
            <div class="hm-card__body">
                <p class="hm-card__title">Médicos</p>
                <p class="hm-card__desc">Especialidades y licencias activas</p>
            </div>
            <span class="hm-card__arrow" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </span>
        </a>

        {{-- 3. Citas Médicas --}}
        <a href="{{ route('appointments.index') }}" class="hm-card">
            <span class="hm-card__icon hm-card__icon--orange">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.6"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <path d="M16 2v4M8 2v4M3 10h18"/>
                    <path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/>
                </svg>
            </span>
            <div class="hm-card__body">
                <p class="hm-card__title">Citas médicas</p>
                <p class="hm-card__desc">Control de turnos y salas</p>
            </div>
            <span class="hm-card__arrow" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </span>
        </a>

        {{-- 4. Diagnósticos --}}
        <a href="{{ route('diagnoses.index') }}" class="hm-card">
            <span class="hm-card__icon hm-card__icon--slate">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.6"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <path d="M9 12h6M9 16h4"/>
                </svg>
            </span>
            <div class="hm-card__body">
                <p class="hm-card__title">Diagnósticos</p>
                <p class="hm-card__desc">Evaluaciones y tipos de gravedad</p>
            </div>
            <span class="hm-card__arrow" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </span>
        </a>

        {{-- 5. Tratamientos --}}
        <a href="{{ route('treatments.index') }}" class="hm-card">
            <span class="hm-card__icon hm-card__icon--red">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.6"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7z"/>
                    <path d="M8.5 8.5 16 16"/>
                </svg>
            </span>
            <div class="hm-card__body">
                <p class="hm-card__title">Tratamientos</p>
                <p class="hm-card__desc">Planes de recuperación y duraciones</p>
            </div>
            <span class="hm-card__arrow" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </span>
        </a>

    </div>
</div>

<style>

    /* ── Wrapper ─────────────────────────────────────────────────── */
    .hm-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem;
    }

    /* ── Header ─────────────────────────────────────────────────── */
    .hm-eyebrow {
        display: block;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 0.75rem;
    }

    .hm-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #0f172a;
        margin: 0 0 0.4rem;
        letter-spacing: -0.3px;
    }

    .hm-subtitle {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0 0 2rem;
        line-height: 1.5;
    }

    /* ── Stats bar ──────────────────────────────────────────────── */
    .hm-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 10px;
        margin-bottom: 2rem;
    }

    .hm-stat {
        background: #f8fafc;
        border: 0.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem 1.1rem;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .hm-stat__number {
        font-size: 1.5rem;
        font-weight: 600;
        color: #0f172a;
        line-height: 1;
    }

    .hm-stat__label {
        font-size: 0.75rem;
        color: #64748b;
        line-height: 1.3;
    }

    /* ── Divider ─────────────────────────────────────────────────── */
    .hm-divider {
        border: none;
        border-top: 0.5px solid #e2e8f0;
        margin: 0 0 1.75rem;
    }

    /* ── Module grid ────────────────────────────────────────────── */
    .hm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
        gap: 10px;
    }

    /* ── Card ────────────────────────────────────────────────────── */
    .hm-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #ffffff;
        border: 0.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.1rem 1.25rem;
        text-decoration: none;
        color: inherit;
        transition: border-color 0.15s ease, background 0.15s ease;
    }

    .hm-card:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }

    .hm-card:hover .hm-card__arrow {
        opacity: 1;
        transform: translateX(2px);
    }

    /* ── Card icon ───────────────────────────────────────────────── */
    .hm-card__icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hm-card__icon--blue   { background: #eff6ff; color: #3b82f6; }
    .hm-card__icon--green  { background: #f0fdf4; color: #22c55e; }
    .hm-card__icon--orange { background: #fff7ed; color: #f97316; }
    .hm-card__icon--slate  { background: #f1f5f9; color: #64748b; }
    .hm-card__icon--red    { background: #fef2f2; color: #ef4444; }

    /* ── Card body ───────────────────────────────────────────────── */
    .hm-card__body {
        flex: 1;
        min-width: 0;
    }

    .hm-card__title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 3px;
    }

    .hm-card__desc {
        font-size: 0.78rem;
        color: #94a3b8;
        margin: 0;
        line-height: 1.4;
    }

    /* ── Card arrow ──────────────────────────────────────────────── */
    .hm-card__arrow {
        flex-shrink: 0;
        color: #94a3b8;
        opacity: 0.5;
        transition: opacity 0.15s ease, transform 0.15s ease;
        display: flex;
        align-items: center;
    }

    /* ── Responsive ─────────────────────────────────────────────── */
    @media (max-width: 640px) {
        .hm-wrapper   { padding: 1.5rem 1rem; }
        .hm-title     { font-size: 1.4rem; }
        .hm-stats     { grid-template-columns: 1fr 1fr; }
        .hm-grid      { grid-template-columns: 1fr; }
    }

</style>

@endsection