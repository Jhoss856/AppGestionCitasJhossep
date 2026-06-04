@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-container-card">
        
        <!-- PANEL IZQUIERDO: ILUSTRACIÓN ANIMADA DEL AVATAR -->
        <div class="auth-visual-panel" style="background: linear-gradient(135deg, #312e81 0%, var(--brand-dark) 100%);">
            <div class="confused-avatar-box">
                <div class="avatar-head">
                    <div class="avatar-mouth"></div>
                </div>
                <div class="floating-question">?</div>
            </div>
            <h3 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 10px;">¿Problemas de Acceso?</h3>
            <p style="opacity: 0.85; font-size: 0.9rem; max-width: 280px; line-height: 1.5;">No te preocupes. Introduce tu correo institucional y te enviaremos una vía de sincronización segura para restaurar tu contraseña.</p>
        </div>

        <!-- PANEL DERECHO: FORMULARIO -->
        <div class="auth-form-panel">
            <h2>Restablecer Contraseña</h2>
            <p>Ingresa tu dirección de correo electrónico validada en el sistema.</p>

            <!-- Alerta automática de Laravel si el correo de recuperación se envió correctamente -->
            @if (session('status'))
                <div class="status-alert-success">
                    🔒 ¡Listo! {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="modern-input-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="ejemplo@clinisync.com">
                    @error('email') 
                        <span style="color: var(--accent-danger); font-size: 0.8rem; margin-top: 4px; display: block;">
                            {{ $message }}
                        </span> 
                    @enderror
                </div>

                <button type="submit" class="btn-auth-primary" style="width: 100%; padding: 13px; margin-top: 10px; font-weight: 600;">
                    Enviar Enlace de Recuperación
                </button>

                <p style="text-align: center; margin-top: 25px; margin-bottom: 0; font-size: 0.85rem;">
                    ¿Recordaste tus datos? <a href="{{ route('login') }}" class="forgot-link">Volver al Login</a>
                </p>
            </form>
        </div>

    </div>
</div>
@endsection
