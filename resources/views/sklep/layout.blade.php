<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Sklep') — LaravelShop</title>
  <link rel="stylesheet" href="{{ asset('css/sklep.css') }}">
  {{-- lub jeśli używasz Vite: @vite('resources/css/sklep.css') --}}
</head>
<body>

@include('partials.header')

  @if(session('error'))
    <div class="container">
      <div class="flash flash-error" role="alert">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
          <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                clip-rule="evenodd"/>
        </svg>
        {{ session('error') }}
      </div>
    </div>
  @endif

  <main class="site-main">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-inner">
        <p>© {{ date('Y') }} LaravelShop. Wszelkie prawa zastrzeżone.</p>
        <div class="footer-p24">
          <span>P24</span>
          Bezpieczne płatności Przelewy24
        </div>
      </div>
    </div>
  </footer>

  @stack('scripts')
</body>
</html>
