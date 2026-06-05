@extends('layouts.app')

@section('content')
<div class="simple-auth-wrapper">
    <div class="simple-auth-card">

        <div class="card-icon">✉️</div>

        <h2>Verifica tu Correo</h2>
        <p>Antes de continuar, revisa tu bandeja de entrada. Te enviamos un enlace de verificación.</p>

        @if (session('resent'))
            <div class="alert-success">
                ✓ Se envió un nuevo enlace a tu dirección de correo electrónico.
            </div>
        @endif

        <div class="alert-info">
            ¿No recibiste el correo? Revisa tu carpeta de spam o solicita uno nuevo.
        </div>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn-auth-primary" style="margin-bottom: 16px;">
                Reenviar Enlace de Verificación
            </button>
        </form>

        <p style="text-align: center; font-size: 0.85rem; margin: 0;">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-verify-form').submit();"
               class="forgot-link">Salir del sistema</a>
        </p>
        <form id="logout-verify-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </div>
</div>
@endsection