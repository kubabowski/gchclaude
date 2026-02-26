{{-- resources/views/sklep/layout.blade.php --}}
{{-- Zaktualizowano: layout sklepu dopasowany do stylu strony głównej GCHemp --}}
    <!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sklep') — GCHemp</title>

    {{-- Fonty identyczne jak strona główna --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    {{-- CSS sklepu (nadpisuje zmienne na jasny motyw GCHemp) --}}
    <link rel="stylesheet" href="{{ asset('css/sklep.css') }}">

    <link rel="icon" href="/favicon.ico" sizes="any">
</head>
<body class="sklep-body">

{{-- ── Header identyczny jak na stronie głównej ── --}}
<header class="header sklep-header" role="banner">
    <nav class="navbar" role="navigation" aria-label="Główna nawigacja">
        <div class="container">
            <div class="navbar-brand">
                <a href="/" class="logo-link" aria-label="GCHemp - Strona główna">
                    <img src="https://www.gchemp.pl/assets/images/logo.png" alt="Logo GCHemp" class="logo" width="180" height="60">
                </a>
            </div>

            <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" id="navToggle">
                <span class="hamburger"></span>
                <span class="hamburger"></span>
                <span class="hamburger"></span>
            </button>

            <ul class="nav-menu" id="navMenu" role="list">
                <li><a href="/#about"   class="nav-link">O Nas</a></li>
                <li><a href="/#product" class="nav-link">Produkt</a></li>
                <li><a href="/sklep"    class="nav-link nav-link--active">Sklep</a></li>
                <li><a href="/#contact" class="nav-link">Kontakt</a></li>
            </ul>
        </div>
    </nav>
</header>

{{-- ── Flash / błędy ── --}}
@if(session('error'))
    <div class="sklep-flash-wrap container">
        <div class="sklep-flash sklep-flash--error" role="alert">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                      clip-rule="evenodd"/>
            </svg>
            {{ session('error') }}
        </div>
    </div>
@endif

{{-- ── Breadcrumb ── --}}
<div class="sklep-breadcrumb">
    <div class="container">
        <nav aria-label="Ścieżka nawigacji">
            <ol class="breadcrumb-list">
                <li><a href="/" class="breadcrumb-link">Strona główna</a></li>
                <li aria-hidden="true" class="breadcrumb-sep">›</li>
                <li class="breadcrumb-current">@yield('breadcrumb', 'Sklep')</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── Treść ── --}}
<main class="sklep-main" id="main-content">
    <div class="container">
        @yield('content')
    </div>
</main>

{{-- ── Stopka sklepu ── --}}
<footer class="sklep-footer">
    <div class="container">
        <div class="sklep-footer-inner">
            <div class="sklep-footer-brand">
                <img src="https://www.gchemp.pl/assets/images/logo.png" alt="GCHemp" height="36">
                <p>© {{ date('Y') }} GCHemp. Wszelkie prawa zastrzeżone.</p>
            </div>
            <div class="sklep-footer-links">
                <a href="/polityka-prywatnosci">Polityka prywatności</a>
                <a href="/regulamin">Regulamin</a>
                <a href="/rodo">RODO</a>
            </div>
            <div class="sklep-footer-p24">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Bezpieczne płatności Przelewy24
            </div>
        </div>
    </div>
</footer>

{{-- ── JS: hamburger menu ── --}}
<script>
    (function () {
        const toggle = document.getElementById('navToggle');
        const menu   = document.getElementById('navMenu');
        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', String(!expanded));
                menu.classList.toggle('active');
            });
        }
    })();
</script>

@stack('scripts')
</body>
</html>
