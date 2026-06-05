@extends('layouts.app')

@section('content')
<div class="simple-auth-wrapper">
    <div class="simple-auth-card">

        <div class="card-icon">🔑</div>

        <h2>Nueva Contraseña</h2>
        <p>Elige una contraseña segura para restablecer el acceso a tu cuenta.</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="modern-input-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email"
                       value="{{ $email ?? old('email') }}"
                       required autocomplete="email" autofocus
                       placeholder="ejemplo@SincroAgenda.com">
                @error('email')
                    <span style="color: var(--danger); font-size: 0.8rem; margin-top: 3px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="modern-input-group">
                <label for="password">Nueva Contraseña</label>
                <input id="password" type="password" name="password"
                       required autocomplete="new-password"
                       placeholder="Mínimo 8 caracteres">
                @error('password')
                    <span style="color: var(--danger); font-size: 0.8rem; margin-top: 3px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="modern-input-group">
                <label for="password-confirm">Confirmar Contraseña</label>
                <input id="password-confirm" type="password"
                       name="password_confirmation"
                       required autocomplete="new-password"
                       placeholder="Repite tu nueva contraseña">
            </div>

            <button type="submit" class="btn-auth-primary" style="margin-top: 10px;">
                Restablecer Contraseña
            </button>

            <p style="text-align: center; margin-top: 18px; font-size: 0.85rem;">
                <a href="{{ route('login') }}" class="forgot-link">Volver al inicio de sesión</a>
            </p>
        </form>

    </div>
</div>
@endsection