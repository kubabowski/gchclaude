@extends('sklep.layout')

@section('title', 'Przetwarzanie płatności')

@section('content')
<div class="status-page animate-fade-in">
  <div class="status-card">

    {{-- Icon --}}
    @if($order->isPaid())
      <div class="status-icon status-icon-success" aria-hidden="true">
        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color:var(--green)">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
    @elseif($order->status === 'failed')
      <div class="status-icon status-icon-failed" aria-hidden="true">
        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color:var(--red)">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </div>
    @else
      <div class="status-icon status-icon-pending" aria-hidden="true">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:var(--yellow);animation:spin 3s linear infinite">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
    @endif

    {{-- Status badge --}}
    @if($order->isPaid())
      <div class="badge badge-success">
        <svg viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
        Płatność potwierdzona
      </div>
    @elseif($order->status === 'failed')
      <div class="badge badge-failed">
        <svg viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
        Płatność nieudana
      </div>
    @else
      <div class="badge badge-pending" aria-live="polite">
        <svg viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
        Oczekiwanie na potwierdzenie
      </div>
    @endif

    <h1 class="status-title">Przetwarzamy Twoją płatność</h1>
    <p class="status-desc">
      Wróciłeś z bramki Przelewy24. Weryfikujemy status Twojego zamówienia — może to chwilę zająć.
    </p>

    {{-- Order detail --}}
    <dl class="order-detail" aria-label="Szczegóły zamówienia">
      <div class="order-detail-title">Szczegóły zamówienia</div>
      <div class="order-detail-row">
        <dt>Produkt</dt>
        <dd>{{ $order->product_name }}</dd>
      </div>
      <div class="order-detail-row">
        <dt>Ilość</dt>
        <dd>{{ $order->quantity }} szt.</dd>
      </div>
      <div class="order-detail-total">
        <dt>Łącznie</dt>
        <dd style="color:var(--accent)">{{ $order->total_formatted }}</dd>
      </div>
    </dl>

    {{-- Actions --}}
    @if($order->isPaid())
      <a href="{{ route('sklep.success', ['sessionId' => $order->session_id]) }}"
         class="btn btn-primary btn-full">
        Przejdź do potwierdzenia
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
      </a>
    @elseif($order->status === 'failed')
      <a href="{{ route('sklep.index') }}" class="btn btn-primary btn-full">
        Spróbuj ponownie
      </a>
    @else
      <p class="refresh-note" role="status" aria-live="polite">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Strona odświeży się automatycznie za chwilę…
      </p>
      <script>setTimeout(function(){ location.reload(); }, 3000);</script>
    @endif

  </div>
</div>
@endsection
