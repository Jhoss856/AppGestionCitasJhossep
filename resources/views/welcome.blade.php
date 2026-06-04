@extends('layouts.app')

@section('content')
<div class="auth-split-container">
    
    <div class="auth-left-side">
        <div class="brand-title-large">CliniSync<span>+</span></div>
        <p class="brand-description">
            Una solución tecnológica integral diseñada para optimizar la administración de registros clínicos, gestión de personal médico y control de flujos operativos en centros de salud modernos.
        </p>
    </div>

    <div class="auth-right-side">
        <h2 class="auth-action-title">Comenzar en el Sistema</h2>
        <p class="auth-action-subtitle">Por favor, elija una de las siguientes opciones para continuar:</p>
        
        <div class="auth-btn-group">
            <a href="{{ route('login') }}" class="btn-auth-primary">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn-auth-secondary">Crear Cuenta</a>
        </div>
    </div>

</div>
@endsection