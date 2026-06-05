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

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modern-input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ejemplo@clinica.com">
                    <!-- Captura de errores de Laravel -->
                    @error('email') <span class="error-msg" style="color:var(--danger); font-size:0.8rem; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <div class="modern-input-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required placeholder="••••••••">
                    @error('password') <span class="error-msg" style="color:var(--danger); font-size:0.8rem; margin-top:4px;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn-auth-primary">Acceder al Sistema</button>

                <p style="text-align: center; margin-top: 25px; font-size: 0.9rem;">
                    ¿Nuevo en el centro médico? <a href="{{ route('register') }}" style="color: var(--teal); font-weight: 600;">Regístrate aquí</a>
                </p>
            </form>
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
            return; // Detenemos la animación si hay error
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
                    // Borrando
                    tablet.classList.add('state-erasing');
                    face.innerText = "🤔"; 
                    screen.innerText = "Borrando registro...";
                } else {
                    // Escribiendo
                    tablet.classList.add('state-writing');
                    face.innerText = "👨🏻‍💻"; 
                    screen.innerText = "Ingresando datos: " + '*'.repeat(currentLength > 5 ? 5 : currentLength) + "...";
                }

                lastValueLengths[input.name] = currentLength;

                // Retorno al estado normal
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