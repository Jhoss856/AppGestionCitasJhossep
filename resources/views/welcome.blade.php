@extends('layouts.app')

@section('content')
<div class="welcome-container">
    <!-- Gradiente de fondo -->
    <div class="blob-bg"></div>

    <main class="hero-section">
        <!-- Contenido principal -->
        <div class="hero-content">
            <div class="badge-pill">
                <span class="pulse"></span> Versión 2.0 Estable
            </div>
            <h1>El futuro de la <br><span style="color: var(--teal);">gestión en clínica</span> <br>está en tus manos.</h1>
            <p style="margin: 20px 0 30px 0; color: #64748b; line-height: 1.6; max-width: 450px;">
                Nuestra plataforma permite gestionar citas reales con total comodidad desde cualquier lugar. ¡No esperes más y programa tu consulta!
            </p>
            
            <div class="cta-group" style="display: flex; align-items: center; gap: 15px;">
                <a href="{{ route('login') }}" class="btn-main">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn-secondary">Registrar Cuenta</a>
            </div>
        </div>

        <!-- Tarjeta de sistema visual -->
        <div class="hero-card">
            <div class="card-glass">
                <small style="color: #94a3b8; font-weight: 600;">Dashboard Preview</small>
                <h3 style="margin: 5px 0 20px 0;">SincroAgenda v2.0</h3>
                <div class="stats-mini" style="display: flex; gap: 20px;">
                    <div class="stat-item"><span>+120</span> Pacientes</div>
                    <div class="stat-item"><span>98%</span> Eficiencia</div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
    .welcome-container { min-height: 80vh; display: flex; align-items: center; padding: 0 10%; position: relative; }
    
    .blob-bg { position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, var(--teal-light), transparent 70%); filter: blur(100px); opacity: 0.3; top: 10%; right: 5%; z-index: 0; }

    .hero-section { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 60px; align-items: center; z-index: 1; width: 100%; }

    h1 { font-size: 3.5rem; line-height: 1.1; color: #1e293b; margin: 0; }

    .badge-pill { background: #f1f5f9; padding: 6px 16px; border-radius: 50px; display: inline-flex; align-items: center; gap: 8px; font-size: 0.75rem; font-weight: 700; color: #475569; border: 1px solid #e2e8f0; margin-bottom: 20px; }

    .pulse { width: 8px; height: 8px; background: var(--teal); border-radius: 50%; box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.2); }

    .btn-main { background: #0f172a; color: white; padding: 14px 28px; border-radius: 10px; font-weight: 600; text-decoration: none; transition: 0.3s; }
    .btn-main:hover { background: var(--teal); transform: translateY(-2px); }
    .btn-secondary { color: #0f172a; font-weight: 600; text-decoration: none; padding: 14px 20px; }

    .card-glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); padding: 35px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1); }

    .stat-item { background: #f8fafc; padding: 12px 18px; border-radius: 12px; font-size: 0.9rem; font-weight: 700; border: 1px solid #e2e8f0; }
</style>
@endsection