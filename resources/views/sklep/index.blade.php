@extends('sklep.layout')

@section('title', $product['name'])

@section('content')
<div class="animate-slide-up">

  {{-- ── Hero ───────────────────────────────────────────────── --}}
  <section class="shop-hero">
    <div class="shop-hero-badge" aria-hidden="true">
      <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
      </svg>
      Bestseller · Limitowany dostęp
    </div>

    <h1>
      Jeden produkt.<br><em>Nieograniczone możliwości.</em>
    </h1>
    <p>Zamów teraz i uzyskaj natychmiastowy dostęp do wszystkich materiałów.</p>
  </section>

  {{-- ── Product grid ────────────────────────────────────────── --}}
  <div class="product-grid">

    {{-- Left: Info --}}
    <article class="product-card" aria-label="{{ $product['name'] }}">
      <div class="product-image-wrap">
        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" loading="lazy">
        <div class="product-price-badge">
          <small>Cena za sztukę</small>
          <strong>{{ number_format($product['price'] / 100, 2, ',', ' ') }} PLN</strong>
        </div>
      </div>

      <div class="product-body">
        <h2 class="product-name">{{ $product['name'] }}</h2>
        <p class="product-desc">{{ $product['description'] }}</p>

        <ul class="feature-list" role="list">
          @foreach($product['features'] as $feature)
          <li class="feature-item">
            <span class="feature-check" aria-hidden="true">
              <svg fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg>
            </span>
            {{ $feature }}
          </li>
          @endforeach
        </ul>
      </div>
    </article>

    {{-- Right: Order form --}}
    <section class="order-card" aria-label="Formularz zamówienia">
      <h2 class="order-card-title">Złóż zamówienie</h2>

      <form action="{{ route('sklep.checkout') }}" method="POST" id="orderForm" novalidate>
        @csrf

        <div class="form-stack">
          {{-- Name --}}
          <div class="form-group">
            <label class="form-label" for="customer_name">Imię i nazwisko</label>
            <input class="form-input"
                   type="text"
                   id="customer_name"
                   name="customer_name"
                   value="{{ old('customer_name') }}"
                   placeholder="Jan Kowalski"
                   autocomplete="name"
                   required>
            @error('customer_name')
              <span class="form-error" role="alert">{{ $message }}</span>
            @enderror
          </div>

          {{-- Email --}}
          <div class="form-group">
            <label class="form-label" for="customer_email">Adres e-mail</label>
            <input class="form-input"
                   type="email"
                   id="customer_email"
                   name="customer_email"
                   value="{{ old('customer_email') }}"
                   placeholder="jan@example.com"
                   autocomplete="email"
                   required>
            @error('customer_email')
              <span class="form-error" role="alert">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <hr class="divider">

        {{-- Quantity --}}
        <div class="form-group" style="margin-bottom: 24px">
          <label class="form-label" for="quantity">Ilość</label>
          <div class="qty-wrap" role="group" aria-label="Wybierz ilość">
            <button type="button" class="qty-btn" id="decreaseBtn"
                    aria-label="Zmniejsz ilość">−</button>
            <input class="qty-input"
                   type="number"
                   id="quantity"
                   name="quantity"
                   value="{{ old('quantity', 1) }}"
                   min="1"
                   max="99"
                   aria-label="Ilość"
                   required>
            <button type="button" class="qty-btn" id="increaseBtn"
                    aria-label="Zwiększ ilość">+</button>
          </div>
          @error('quantity')
            <span class="form-error" role="alert">{{ $message }}</span>
          @enderror
        </div>

        {{-- Summary --}}
        <div class="order-summary" aria-live="polite" aria-label="Podsumowanie zamówienia">
          <div class="summary-row">
            <span>Cena jednostkowa</span>
            <span id="unitPriceSummary">{{ number_format($product['price'] / 100, 2, ',', ' ') }} PLN</span>
          </div>
          <div class="summary-row">
            <span>Ilość</span>
            <span id="summaryQty">1 szt.</span>
          </div>
          <div class="summary-total">
            <span class="summary-total-label">Łącznie</span>
            <span class="summary-total-price" id="totalPrice">
              {{ number_format($product['price'] / 100, 2, ',', ' ') }} PLN
            </span>
          </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary btn-full" id="submitBtn">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
          <span id="submitText">Zapłać przez Przelewy24</span>
          <div class="spinner" id="spinner" aria-hidden="true"></div>
        </button>

        <p class="security-note">
          <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd"/>
          </svg>
          Szyfrowane połączenie SSL · Przelewy24
        </p>
      </form>
    </section>

  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  var unitGr  = {{ (int) $product['price'] }};
  var qtyEl   = document.getElementById('quantity');
  var sumQty  = document.getElementById('summaryQty');
  var total   = document.getElementById('totalPrice');
  var decBtn  = document.getElementById('decreaseBtn');
  var incBtn  = document.getElementById('increaseBtn');
  var sbBtn   = document.getElementById('submitBtn');
  var sbText  = document.getElementById('submitText');
  var spinner = document.getElementById('spinner');

  function fmt(gr) {
    return (gr / 100).toFixed(2).replace('.', ',') + ' PLN';
  }

  function refresh() {
    var q = Math.max(1, Math.min(99, parseInt(qtyEl.value, 10) || 1));
    qtyEl.value       = q;
    sumQty.textContent = q + ' szt.';
    total.textContent  = fmt(unitGr * q);
  }

  decBtn.addEventListener('click', function () { qtyEl.value = Math.max(1,  parseInt(qtyEl.value, 10) - 1); refresh(); });
  incBtn.addEventListener('click', function () { qtyEl.value = Math.min(99, parseInt(qtyEl.value, 10) + 1); refresh(); });
  qtyEl.addEventListener('input', refresh);

  document.getElementById('orderForm').addEventListener('submit', function () {
    sbBtn.disabled        = true;
    sbText.textContent    = 'Przekierowanie…';
    spinner.style.display = 'block';
  });

  refresh();
}());
</script>
@endpush
