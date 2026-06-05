@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-container-card">

        <!-- PANEL VISUAL -->
        <div class="auth-visual-panel">
            <h3 style="font-size: 2rem; font-family: 'Outfit', sans-serif; font-weight: 700; margin-bottom: 15px; color: white;">Accede a nuestro Sistema</h3>
            <p style="opacity: 0.85; font-size: 1rem; max-width: 300px; line-height: 1.6; color: white;">Tendras grandes beneficios y citas que no duran una eternidad, logueate y obten mas informacion en nuestra pagina.</p>
        </div>

        <!-- FORMULARIO -->
        <div class="auth-form-panel">
            <h2>Iniciar Sesión</h2>
            <p>Ingresa tus credenciales corporativas.</p>

            <!-- Captura de errores generales de OAuth (Google/GitHub) -->
            @if(session('error'))
                <div style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545; padding: 10px; border-radius: 6px; font-size: 0.85rem; margin-bottom: 15px; border: 1px solid rgba(220, 53, 69, 0.2); text-align: center;">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modern-input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ejemplo@clinica.com">
                    @error('email') <span class="error-msg" style="color:var(--danger); font-size:0.8rem; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="modern-input-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required placeholder="••••••••">
                    @error('password') <span class="error-msg" style="color:var(--danger); font-size:0.8rem; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn-auth-primary">Acceder al Sistema</button>
            </form>

            <!-- SEPARADOR VISUAL PARA OAUTH -->
            <div style="display: flex; align-items: center; text-align: center; margin: 20px 0; color: #888; font-size: 0.85rem;">
                <div style="flex: 1; border-bottom: 1px solid #eee;"></div>
                <span style="padding: 0 10px;">O accede con</span>
                <div style="flex: 1; border-bottom: 1px solid #eee;"></div>
            </div>

            <!-- BOTONES DE INICIO DE SESIÓN SOCIAL -->
            <div style="display: flex; gap: 10px; justify-content: space-between;">
                <!-- Botón Google -->
                <a href="{{ route('login.google') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px; border: 1px solid #ddd; border-radius: 8px; color: #333; text-decoration: none; font-size: 0.9rem; font-weight: 500; background-color: #fff; transition: background-color 0.2s;">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    Google
                </a>

                <!-- Botón GitHub -->
                <a href="{{ route('login.github') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px; border: 1px solid #333; border-radius: 8px; color: #fff; text-decoration: none; font-size: 0.9rem; font-weight: 500; background-color: #24292e; transition: opacity 0.2s;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.483 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.577.688.479C19.138 20.161 22 16.416 22 12c0-5.523-4.477-10-10-10z"/>
                    </svg>
                    GitHub
                </a>
            </div>

            <p style="text-align: center; margin-top: 25px; font-size: 0.9rem;">
                ¿Nuevo en el centro médico? <a href="{{ route('register') }}" style="color: var(--teal); font-weight: 600;">Regístrate aquí</a>
            </p>
        </div>
    </div>

    <!-- EL BOT ASISTENTE CON SU TABLETA -->
    <div class="sincro-bot-wrapper" id="sincro-bot">
        <div class="bot-face" id="bot-face">👨🏻‍⚕️</div>
        
        <div class="bot-tablet" id="bot-tablet">
            <div class="tablet-screen" id="tablet-screen">
                Sistema listo. Esperando credenciales...
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const face = document.getElementById('bot-face');
        const tablet = document.getElementById('bot-tablet');
        const screen = document.getElementById('tablet-screen');
        const inputs = document.querySelectorAll('input');
        
        let typingTimer;
        let lastValueLengths = {};

        // 1. Detectar si Laravel devolvió un error al intentar loguearse
        const hasError = document.querySelector('.error-msg');
        
        if (hasError) {
            tablet.classList.add('state-error');
            face.innerText = "😠";
            screen.innerText = "¡Datos incorrectos! Acceso denegado.";
            return;
        }

        // 2. Animación al Escribir y Borrar
        inputs.forEach(input => {
            lastValueLengths[input.name] = input.value.length;

            input.addEventListener('input', function(e) {
                clearTimeout(typingTimer);
                
                const currentLength = e.target.value.length;
                const previousLength = lastValueLengths[input.name] || 0;

                tablet.classList.remove('state-writing', 'state-erasing', 'state-error');

                if (currentLength < previousLength) {
                    tablet.classList.add('state-erasing');
                    face.innerText = "🤔"; 
                    screen.innerText = "Borrando registro...";
                } else {
                    tablet.classList.add('state-writing');
                    face.innerText = "👨🏻‍💻"; 
                    screen.innerText = "Ingresando datos: " + '*'.repeat(currentLength > 5 ? 5 : currentLength) + "...";
                }

                lastValueLengths[input.name] = currentLength;

                typingTimer = setTimeout(() => {
                    tablet.classList.remove('state-writing', 'state-erasing');
                    face.innerText = "👨🏻‍⚕️";
                    screen.innerText = "Esperando siguiente acción...";
                }, 1000);
            });
        });
    });
</script>
@endsection