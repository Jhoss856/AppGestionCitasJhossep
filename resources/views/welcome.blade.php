@extends('layouts.app')

@section('content')

{{--
|--------------------------------------------------------------------------
| welcome.blade.php — Página de Bienvenida
| Layout: hero split — copy + card preview
|--------------------------------------------------------------------------
--}}

<div class="wl-wrapper">

    {{-- ─── Hero ─────────────────────────────────────────────────── --}}
    <section class="wl-hero" aria-labelledby="wl-heading">

        {{-- columna izquierda: copy --}}
        <div class="wl-copy">

            <span class="wl-badge">
                <span class="wl-badge__dot" aria-hidden="true"></span>
                Versión 2.0 estable
            </span>

            <h1 id="wl-heading" class="wl-heading">
                Gestión clínica <br>
                <span class="wl-heading--accent">simple y precisa.</span>
            </h1>

            <p class="wl-lead">
                Administra citas, pacientes y diagnósticos desde un solo lugar.
                Sin complejidades, sin tiempo perdido.
            </p>

            <div class="wl-cta">
                <a href="{{ route('login') }}" class="wl-btn wl-btn--primary">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}" class="wl-btn wl-btn--ghost">
                    Crear cuenta
                </a>
            </div>

            <p class="wl-note">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true" style="vertical-align:-2px;margin-right:5px">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                Datos protegidos · Sin anuncios
            </p>

        </div>

        {{-- columna derecha: preview card --}}
        <div class="wl-preview" aria-hidden="true">

            <div class="wl-card">

                <div class="wl-card__header">
                    <div class="wl-card__avatar">SA</div>
                    <div>
                        <p class="wl-card__name">SincroAgenda</p>
                        <p class="wl-card__version">v2.0</p>
                    </div>
                    <span class="wl-card__status">
                        <span class="wl-card__status-dot"></span>
                        En línea
                    </span>
                </div>

                <hr class="wl-card__divider">

                <div class="wl-card__stats">
                    <div class="wl-card__stat">
                        <span class="wl-card__stat-n">+120</span>
                        <span class="wl-card__stat-l">Pacientes</span>
                    </div>
                    <div class="wl-card__stat">
                        <span class="wl-card__stat-n">98%</span>
                        <span class="wl-card__stat-l">Eficiencia</span>
                    </div>
                    <div class="wl-card__stat">
                        <span class="wl-card__stat-n">5</span>
                        <span class="wl-card__stat-l">Módulos</span>
                    </div>
                </div>

                <hr class="wl-card__divider">

                <ul class="wl-card__list">
                    <li class="wl-card__item">
                        <span class="wl-card__dot wl-card__dot--blue"></span>
                        Pacientes
                        <span class="wl-card__tag">124 registros</span>
                    </li>
                    <li class="wl-card__item">
                        <span class="wl-card__dot wl-card__dot--green"></span>
                        Citas hoy
                        <span class="wl-card__tag">18 programadas</span>
                    </li>
                    <li class="wl-card__item">
                        <span class="wl-card__dot wl-card__dot--orange"></span>
                        Diagnósticos
                        <span class="wl-card__tag">Actualizados</span>
                    </li>
                </ul>

            </div>

            {{-- micro-features debajo de la card --}}
            <div class="wl-features">
                <span class="wl-feature">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Acceso multiplataforma
                </span>
                <span class="wl-feature">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Actualizaciones en tiempo real
                </span>
            </div>

        </div>
    </section>

    {{-- ─── Características (opcional: remover si no se requiere) ── --}}
    <section class="wl-perks" aria-label="Características principales">
        <div class="wl-perk">
            <span class="wl-perk__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </span>
            <div>
                <p class="wl-perk__title">Agenda inteligente</p>
                <p class="wl-perk__desc">Programa y reasigna citas sin conflictos de horario.</p>
            </div>
        </div>
        <div class="wl-perk">
            <span class="wl-perk__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <path d="M9 12h6M9 16h4"/>
                </svg>
            </span>
            <div>
                <p class="wl-perk__title">Historial centralizado</p>
                <p class="wl-perk__desc">Accede al expediente completo de cada paciente al instante.</p>
            </div>
        </div>
        <div class="wl-perk">
            <span class="wl-perk__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
            </span>
            <div>
                <p class="wl-perk__title">Datos seguros</p>
                <p class="wl-perk__desc">Roles y permisos para proteger la información sensible.</p>
            </div>
        </div>
    </section>

</div>

<style>

    /* ── Wrapper ─────────────────────────────────────────────────── */
    .wl-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 3rem 1.5rem 4rem;
    }

    /* ── Hero ────────────────────────────────────────────────────── */
    .wl-hero {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 5rem;
        align-items: center;
        margin-bottom: 5rem;
    }

    /* ── Badge ───────────────────────────────────────────────────── */
    .wl-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #f1f5f9;
        border: 0.5px solid #e2e8f0;
        border-radius: 50px;
        padding: 5px 14px;
        font-size: 0.72rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 1.25rem;
    }

    .wl-badge__dot {
        width: 7px;
        height: 7px;
        background: #14b8a6;
        border-radius: 50%;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.18);
        animation: wl-pulse 2s infinite;
    }

    @keyframes wl-pulse {
        0%, 100% { box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.18); }
        50%       { box-shadow: 0 0 0 6px rgba(20, 184, 166, 0.08); }
    }

    /* ── Heading ─────────────────────────────────────────────────── */
    .wl-heading {
        font-size: 3rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.12;
        letter-spacing: -0.5px;
        margin: 0 0 1.1rem;
    }

    .wl-heading--accent { color: #14b8a6; }

    /* ── Lead ────────────────────────────────────────────────────── */
    .wl-lead {
        font-size: 0.95rem;
        color: #64748b;
        line-height: 1.65;
        margin: 0 0 2rem;
        max-width: 420px;
    }

    /* ── CTA group ───────────────────────────────────────────────── */
    .wl-cta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.25rem;
    }

    .wl-btn {
        display: inline-flex;
        align-items: center;
        padding: 11px 24px;
        border-radius: 9px;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.15s ease, transform 0.15s ease;
        line-height: 1;
    }

    .wl-btn--primary {
        background: #0f172a;
        color: #ffffff;
    }

    .wl-btn--primary:hover {
        background: #14b8a6;
        transform: translateY(-1px);
    }

    .wl-btn--ghost {
        background: transparent;
        color: #0f172a;
        border: 0.5px solid #e2e8f0;
    }

    .wl-btn--ghost:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    /* ── Micro note ──────────────────────────────────────────────── */
    .wl-note {
        font-size: 0.75rem;
        color: #94a3b8;
        margin: 0;
        display: flex;
        align-items: center;
    }

    /* ── Preview card ────────────────────────────────────────────── */
    .wl-card {
        background: #ffffff;
        border: 0.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
    }

    .wl-card__header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0;
    }

    .wl-card__avatar {
        width: 38px;
        height: 38px;
        background: #0f172a;
        color: #ffffff;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        flex-shrink: 0;
    }

    .wl-card__name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 1px;
    }

    .wl-card__version {
        font-size: 0.72rem;
        color: #94a3b8;
        margin: 0;
    }

    .wl-card__status {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.72rem;
        color: #16a34a;
        font-weight: 600;
    }

    .wl-card__status-dot {
        width: 6px;
        height: 6px;
        background: #22c55e;
        border-radius: 50%;
    }

    .wl-card__divider {
        border: none;
        border-top: 0.5px solid #f1f5f9;
        margin: 1rem 0;
    }

    .wl-card__stats {
        display: flex;
        gap: 0;
    }

    .wl-card__stat {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        padding: 0.5rem 0;
    }

    .wl-card__stat + .wl-card__stat {
        border-left: 0.5px solid #f1f5f9;
    }

    .wl-card__stat-n {
        font-size: 1.2rem;
        font-weight: 600;
        color: #0f172a;
    }

    .wl-card__stat-l {
        font-size: 0.7rem;
        color: #94a3b8;
    }

    .wl-card__list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .wl-card__item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        color: #475569;
    }

    .wl-card__dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .wl-card__dot--blue   { background: #3b82f6; }
    .wl-card__dot--green  { background: #22c55e; }
    .wl-card__dot--orange { background: #f97316; }

    .wl-card__tag {
        margin-left: auto;
        font-size: 0.7rem;
        color: #94a3b8;
        background: #f8fafc;
        border: 0.5px solid #e2e8f0;
        border-radius: 4px;
        padding: 2px 8px;
    }

    /* ── Features row ────────────────────────────────────────────── */
    .wl-features {
        display: flex;
        gap: 16px;
        margin-top: 12px;
        justify-content: center;
    }

    .wl-feature {
        font-size: 0.72rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .wl-feature svg { color: #22c55e; }

    /* ── Perks bar ───────────────────────────────────────────────── */
    .wl-perks {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 12px;
        border-top: 0.5px solid #e2e8f0;
        padding-top: 2.5rem;
    }

    .wl-perk {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .wl-perk__icon {
        flex-shrink: 0;
        width: 36px;
        height: 36px;
        background: #f8fafc;
        border: 0.5px solid #e2e8f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        margin-top: 1px;
    }

    .wl-perk__title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 3px;
    }

    .wl-perk__desc {
        font-size: 0.78rem;
        color: #94a3b8;
        margin: 0;
        line-height: 1.45;
    }

    /* ── Responsive ─────────────────────────────────────────────── */
    @media (max-width: 768px) {
        .wl-hero {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }

        .wl-heading {
            font-size: 2.1rem;
        }

        .wl-preview {
            order: -1;
        }
    }

    @media (max-width: 480px) {
        .wl-wrapper   { padding: 2rem 1rem 3rem; }
        .wl-heading   { font-size: 1.75rem; }
        .wl-cta       { flex-direction: column; align-items: stretch; }
        .wl-btn       { justify-content: center; }
    }

</style>

@endsection