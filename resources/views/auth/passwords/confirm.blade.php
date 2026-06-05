@extends('layouts.app')

@section('content')
<div class="simple-auth-wrapper">
    <div class="simple-auth-card">

        <div class="card-icon">🔐</div>

        <h2>Confirmar Contraseña</h2>
        <p>Por seguridad, confirma tu contraseña antes de continuar con esta acción.</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="modern-input-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password"
                       required autocomplete="current-password"
                       placeholder="Ingresa tu contraseña">
                @error('password')
                    <span style="color: var(--danger); font-size: 0.8rem; margin-top: 3px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-auth-primary" style="margin-top: 8px;">
                Confirmar y Continuar
            </button>

            @if (Route::has('password.request'))
                <p style="text-align: center; margin-top: 18px; font-size: 0.85rem;">
                    <a class="forgot-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </p>
            @endif
        </form>

    </div>
</div>
@endsection