@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-container-card register-card">
        
        <div class="auth-form-panel" style="padding: 40px;">
            <h2 style="border-bottom: 2px solid var(--brand-primary); padding-bottom: 12px;">Crear Cuenta en SincroAgenda</h2>
            <p>Regístrate para comenzar a coordinar citas de forma automatizada.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="modern-input-group">
                    <label>Nombres</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ej. Juan Daniel">
                    @error('name') <span style="color:var(--accent-danger); font-size:0.8rem;">{{ $message }}</span> @enderror
                </div>

                <div class="modern-input-group">
                    <label>Apellidos</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Ej. Puccio Pérez">
                </div>

                <div class="modern-input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="juan.perez@SincroAgenda.com">
                    @error('email') <span style="color:var(--accent-danger); font-size:0.8rem;">{{ $message }}</span> @enderror
                </div>

                <div class="modern-input-group">
                    <label>Contraseña</label>
                    <input type="password" id="passwordField" name="password" required placeholder="Mínimo 8 caracteres">
                    @error('password') <span style="color:var(--accent-danger); font-size:0.8rem;">{{ $message }}</span> @enderror
                    
                    <!-- Medidor Visual de Contraseñas -->
                    <div style="margin-top: 8px;">
                        <div style="background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden;">
                            <div id="meterBar" style="width: 0%; height: 100%; transition: all 0.3s ease;"></div>
                        </div>
                        <span id="meterText" style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 4px; font-weight: 500;">Seguridad: No ingresada</span>
                    </div>
                </div>

                <div class="modern-input-group">
                    <label>Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" required placeholder="Repita su contraseña">
                </div>

                <div class="form-buttons" style="margin-top: 30px;">
                    <a href="/" class="btn-action" style="background:#e2e8f0; color:var(--text-main); display: flex; align-items: center; justify-content: center; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 500;">Cancelar</a>
                    <button type="submit" class="btn-auth-primary" style="padding: 10px 25px;">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EL BOT ASISTENTE INTEGRADO -->
    <div class="sincro-bot-wrapper" id="sincro-bot">
        <div class="bot-face" id="bot-face">👨🏻‍⚕️</div>
        <div class="bot-tablet" id="bot-tablet">
            <div class="tablet-screen" id="tablet-screen">Bienvenido a bordo...</div>
        </div>
    </div>
</div>

<script>
    // Unificación de la lógica del medidor y la animación del bot
    document.addEventListener("DOMContentLoaded", function() {
        const passwordField = document.getElementById('passwordField');
        const bar = document.getElementById('meterBar');
        const text = document.getElementById('meterText');
        const botFace = document.getElementById('bot-face');
        const botTablet = document.getElementById('bot-tablet');
        const screen = document.getElementById('tablet-screen');
        const allInputs = document.querySelectorAll('input');

        // Lógica de medidor de seguridad
        passwordField.addEventListener('input', function(e) {
            const password = e.target.value;
            let score = 0;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password) || /[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            if (password.length === 0) {
                bar.style.width = '0%';
                text.innerText = 'Seguridad: No ingresada';
            } else if (score <= 1) {
                bar.style.width = '33%'; bar.style.backgroundColor = 'var(--accent-danger)';
                text.innerText = 'Seguridad: Débil';
            } else if (score === 2) {
                bar.style.width = '66%'; bar.style.backgroundColor = 'var(--accent-warning)';
                text.innerText = 'Seguridad: Media';
            } else {
                bar.style.width = '100%'; bar.style.backgroundColor = 'var(--accent-success)';
                text.innerText = 'Seguridad: Alta ¡Excelente!';
            }
        });

        // Lógica de animación del bot al interactuar con cualquier campo
        allInputs.forEach(input => {
            input.addEventListener('input', function() {
                botTablet.classList.add('state-writing');
                botFace.innerText = "👨🏻‍💻";
                screen.innerText = "Registrando: " + input.name + "...";
                
                clearTimeout(window.botTimer);
                window.botTimer = setTimeout(() => {
                    botTablet.classList.remove('state-writing');
                    botFace.innerText = "👨🏻‍⚕️";
                    screen.innerText = "SincroAgenda: Registro";
                }, 1500);
            });
        });
    });
</script>
@endsection