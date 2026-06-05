<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SincroAgenda</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Reset y base ───────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:          #f9fafb;
            --surface:     #ffffff;
            --border:      #e5e7eb;
            --border-md:   #d1d5db;
            --text-1:      #111827;
            --text-2:      #374151;
            --text-3:      #6b7280;
            --text-4:      #9ca3af;
            --accent:      #0f172a;
            --teal:        #14b8a6;
            --teal-light:  #f0fdfa;
            --radius-sm:   6px;
            --radius-md:   10px;
            --radius-lg:   14px;
            --shadow-sm:   0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md:   0 4px 12px rgba(0,0,0,0.06);
            --font:        'DM Sans', sans-serif;
            --font-mono:   'DM Mono', monospace;
            --nav-h:       56px;
            --page-max:    1200px;
            --page-pad:    1.5rem;
        }

        html { font-size: 16px; -webkit-font-smoothing: antialiased; }

        body {
            font-family: var(--font);
            background: var(--bg);
            color: var(--text-1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar ─────────────────────────────────────────────── */
        .nav {
            position: sticky;
            top: 0;
            z-index: 50;
            height: var(--nav-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 var(--page-pad);
        }

        .nav__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: var(--page-max);
            margin: 0 auto;
        }

        /* ── Logo ───────────────────────────────────────────────── */
        .nav__logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-1);
        }

        .nav__logo-mark {
            width: 28px;
            height: 28px;
            background: var(--accent);
            color: #fff;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .nav__logo-text {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-1);
            letter-spacing: -0.2px;
        }

        .nav__logo-text span {
            color: var(--teal);
        }

        /* ── Nav right ──────────────────────────────────────────── */
        .nav__right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav__label {
            font-size: 0.78rem;
            color: var(--text-4);
            letter-spacing: 0.02em;
        }

        .nav__logout {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-3);
            text-decoration: none;
            padding: 6px 14px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            transition: background 0.15s ease, color 0.15s ease, border-color 0.15s ease;
            cursor: pointer;
            background: transparent;
            font-family: var(--font);
        }

        .nav__logout:hover {
            background: var(--bg);
            border-color: var(--border-md);
            color: var(--text-1);
        }

        /* ── Main container ─────────────────────────────────────── */
        .main {
            flex: 1;
            max-width: var(--page-max);
            width: 100%;
            margin: 0 auto;
            padding: 2rem var(--page-pad) 3rem;
        }

        /* ── Page header (reutilizable) ─────────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            gap: 1rem;
        }

        .page-header__left {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .page-eyebrow {
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-4);
        }

        .page-title {
            font-size: 1.45rem;
            font-weight: 600;
            color: var(--text-1);
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .page-header__actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        /* ── Buttons ────────────────────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-family: var(--font);
            font-size: 0.83rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s ease, border-color 0.15s ease, transform 0.1s ease;
            line-height: 1;
            white-space: nowrap;
        }

        .btn:active { transform: scale(0.98); }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .btn-primary:hover { background: #1e293b; border-color: #1e293b; }

        .btn-secondary {
            background: var(--surface);
            color: var(--text-2);
            border-color: var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg);
            border-color: var(--border-md);
            color: var(--text-1);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-3);
            border-color: transparent;
        }

        .btn-ghost:hover { background: var(--bg); color: var(--text-1); }

        .btn-danger {
            background: transparent;
            color: #b91c1c;
            border-color: #fca5a5;
        }

        .btn-danger:hover { background: #fef2f2; border-color: #f87171; }

        .btn-teal {
            background: var(--teal);
            color: #fff;
            border-color: var(--teal);
        }

        .btn-teal:hover { background: #0d9488; border-color: #0d9488; }

        /* ── Card / surface ─────────────────────────────────────── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
        }

        .card + .card { margin-top: 1rem; }

        .card__title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-1);
            margin-bottom: 1.25rem;
        }

        /* ── Form elements ──────────────────────────────────────── */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group.span-2 { grid-column: span 2; }

        .form-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-2);
        }

        .form-control {
            width: 100%;
            height: 38px;
            padding: 0 11px;
            font-family: var(--font);
            font-size: 0.875rem;
            color: var(--text-1);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        textarea.form-control {
            height: auto;
            padding: 9px 11px;
            resize: vertical;
            line-height: 1.5;
        }

        select.form-control { cursor: pointer; }

        .form-control::placeholder { color: var(--text-4); }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border);
        }

        /* ── Table ──────────────────────────────────────────────── */
        .table-wrap {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .data-table thead th {
            background: var(--bg);
            padding: 10px 14px;
            text-align: left;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-3);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .data-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.12s ease;
        }

        .data-table tbody tr:last-child { border-bottom: none; }

        .data-table tbody tr:hover { background: #fafafa; }

        .data-table td {
            padding: 12px 14px;
            color: var(--text-2);
            vertical-align: middle;
        }

        .data-table td strong {
            font-family: var(--font-mono);
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-3);
        }

        .td-empty {
            text-align: center;
            color: var(--text-4);
            padding: 3rem 14px !important;
            font-size: 0.875rem;
        }

        /* ── Badges / Pills ─────────────────────────────────────── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .badge-teal  { background: #f0fdfa; color: #0f766e; }
        .badge-blue  { background: #eff6ff; color: #1d4ed8; }
        .badge-slate { background: #f1f5f9; color: #475569; }
        .badge-green { background: #f0fdf4; color: #15803d; }
        .badge-amber { background: #fffbeb; color: #b45309; }
        .badge-red   { background: #fef2f2; color: #b91c1c; }

        /* ── Row actions ────────────────────────────────────────── */
        .row-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ── Divider ────────────────────────────────────────────── */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 1.5rem 0;
        }

        /* ── Toast ──────────────────────────────────────────────── */
        .toast {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            background: var(--accent);
            color: #fff;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: var(--shadow-md);
            transform: translateY(20px);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease, transform 0.25s ease;
        }

        .toast.toast--show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .toast.toast--success { background: #15803d; }
        .toast.toast--error   { background: #b91c1c; }

        .toast__dot {
            width: 6px;
            height: 6px;
            background: rgba(255,255,255,0.7);
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ── Collapsible form panel ──────────────────────────────── */
        .form-panel {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: max-height 0.3s ease, opacity 0.25s ease, margin 0.3s ease;
            margin-bottom: 0;
        }

        .form-panel.form-panel--open {
            max-height: 900px;
            opacity: 1;
            margin-bottom: 1.25rem;
        }

        /* ── Utilities ──────────────────────────────────────────── */
        .mono {
            font-family: var(--font-mono);
            font-size: 0.8rem;
        }

        .text-muted { color: var(--text-3); }
        .text-faint { color: var(--text-4); font-style: italic; }

        /* ── Responsive ─────────────────────────────────────────── */
        @media (max-width: 768px) {
            .page-header        { flex-direction: column; align-items: flex-start; }
            .page-header__actions { flex-wrap: wrap; }
            .form-grid          { grid-template-columns: 1fr; }
            .form-group.span-2  { grid-column: span 1; }
            .main               { padding: 1.25rem 1rem 2rem; }
            .data-table         { font-size: 0.8rem; }
        }
    </style>
</head>
<body>

    {{-- ── Navbar ───────────────────────────────────────────────── --}}
    <nav class="nav">
        <div class="nav__inner">
            <a href="/home" class="nav__logo">
                <span class="nav__logo-mark">SA</span>
                <span class="nav__logo-text">Sincro<span>Agenda</span></span>
            </a>

            <div class="nav__right">
                @auth
                    <button class="nav__logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                @else
                    <span class="nav__label">Gestión Hospitalaria</span>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ── Toast ────────────────────────────────────────────────── --}}
    <div id="app-toast" class="toast" role="status" aria-live="polite">
        <span class="toast__dot"></span>
        <span id="app-toast-msg"></span>
    </div>

    {{-- ── Content ───────────────────────────────────────────────── --}}
    <main class="main">
        @yield('content')
    </main>

    <script>
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        window.showToast = function(msg, type = 'success') {
            const el  = document.getElementById('app-toast');
            const txt = document.getElementById('app-toast-msg');
            if (!el || !txt) return;
            txt.textContent = msg;
            el.className = 'toast toast--show toast--' + type;
            clearTimeout(window.__toastTimer);
            window.__toastTimer = setTimeout(() => {
                el.className = 'toast';
            }, 3500);
        };

        function togglePanel(id) {
            const p = document.getElementById(id);
            if (!p) return;
            p.classList.toggle('form-panel--open');
        }
    </script>
</body>
</html>