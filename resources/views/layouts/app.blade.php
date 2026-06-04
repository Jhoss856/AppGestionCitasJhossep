<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CliniSync - Gestión Hospitalaria</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <nav class="top-navbar">
        <div class="brand-logo">CliniSync<span>+</span></div>
        
        @auth
            <a href="#" class="btn-logout-alt" 
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Salir del Sistema
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <span style="font-size: 0.9rem; opacity: 0.8; color: white;">Gestión Hospitalaria Avanzada</span>
        @authEnd
    </nav>

    <div id="api-toast" class="api-toast hidden"></div>

    <main class="main-container">
        @yield('content')
    </main>

    <script>
        // 1. Configuración global de cabeceras para Fetch
        window.apiHeaders = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        // 2. Función global para mostrar alertas visuales bonitas sin recargar la página
        window.showToast = function(message, type = 'success') {
            const toast = document.getElementById('api-toast');
            toast.textContent = message;
            toast.className = `api-toast show ${type}`;
            
            setTimeout(() => {
                toast.className = 'api-toast hidden';
            }, 3500);
        };
    </script>
</body>
</html>