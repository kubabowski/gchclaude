@extends('sklep.layout')

@section('title', 'Zamówienie potwierdzone!')

@section('content')
<div class="status-page animate-fade-in">
  <div class="status-card">

    {{-- Animated checkmark --}}
    <div class="status-icon status-icon-success" aria-hidden="true">
      <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color:var(--green)">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"
              style="stroke-dasharray:60;stroke-dashoffset:0;animation:checkmark .5s ease .1s both"/>
      </svg>
    </div>

    <div class="badge badge-success">
      <svg viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
      Płatność potwierdzona
    </div>

    <h1 class="status-title">Dziękujemy!</h1>
    <p class="status-desc">
      Płatność przebiegła pomyślnie. Potwierdzenie wysłaliśmy na<br>
      <strong>{{ $order->customer_email }}</strong>
    </p>

    {{-- Order detail --}}
    <dl class="order-detail" aria-label="Podsumowanie zamówienia">
      <div class="order-detail-title">
        Zamówienie
        <span class="order-id-chip" style="margin-left:8px">
          #{{ strtoupper(substr($order->session_id, 0, 8)) }}
        </span>
      </div>
      <div class="order-detail-row">
        <dt>Klient</dt>
        <dd>{{ $order->customer_name }}</dd>
      </div>
      <div class="order-detail-row">
        <dt>E-mail</dt>
        <dd>{{ $order->customer_email }}</dd>
      </div>
      <div class="order-detail-row">
        <dt>Produkt</dt>
        <dd>{{ $order->product_name }}</dd>
      </div>
      <div class="order-detail-row">
        <dt>Ilość</dt>
        <dd>{{ $order->quantity }} szt.</dd>
      </div>
      <div class="order-detail-row">
        <dt>Cena jedn.</dt>
        <dd>{{ $order->unit_formatted }}</dd>
      </div>
      <div class="order-detail-total">
        <dt>Łącznie</dt>
        <dd style="color:var(--green)">{{ $order->total_formatted }}</dd>
      </div>
    </dl>

    {{-- Actions --}}
    <div class="btn-row">
      <a href="{{ route('sklep.index') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Wróć do sklepu
      </a>
      <button onclick="window.print()" class="btn btn-ghost">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
        </svg>
        Drukuj
      </button>
    </div>

  </div>
</div>
@endsection
