
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SincroAgenda</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <nav class="top-navbar">
        <div class="brand-logo">SincroAgenda<span>+</span></div>
        
        @auth
            <a href="#" class="btn-logout-alt" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Salir del Sistema
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <span style="font-size: 0.82rem; opacity: 0.5; color: white; letter-spacing: 0.3px;">Gestión Hospitalaria</span>
        @endauth
    </nav>

    <div id="api-toast" class="api-toast hidden"></div>

    <main class="main-container">
        @yield('content')
    </main>

    <script>
        window.apiHeaders = {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        window.showToast = function(message, type = 'success') {
            const toast = document.getElementById('api-toast');
            if (!toast) return;
            toast.textContent = message;
            toast.className = 'api-toast show ' + type;
            setTimeout(() => { toast.className = 'api-toast hidden'; }, 3500);
        };
    </script>
</body>
</html>    
