@extends('sklep.layout')

@section('title', 'Płatność anulowana')

@section('content')
<div class="status-page animate-fade-in">
  <div class="status-card">

    {{-- Icon --}}
    <div class="status-icon status-icon-cancel" aria-hidden="true">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:var(--yellow)">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
      </svg>
    </div>

    <div class="cancel-line"></div>

    <h1 class="status-title">Płatność anulowana</h1>
    <p class="status-desc">
      Nic się nie stało — nie pobrano żadnych opłat.<br>
      Możesz wrócić i spróbować ponownie w dowolnym momencie.
    </p>

    <div class="btn-row" style="justify-content:center;margin-bottom:28px">
      <a href="{{ route('sklep.index') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Wróć do sklepu
      </a>
    </div>

    <p style="font-size:.8125rem;color:var(--cream-muted)">
      Masz pytania? Napisz na
      <a href="mailto:pomoc@example.com" style="color:var(--accent)">pomoc@example.com</a>
    </p>

  </div>
</div>
@endsection
