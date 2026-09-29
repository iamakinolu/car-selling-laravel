@extends('layouts.app')
@section('content')
<div class="auth-experience auth-reset-page bg-gradient-to-br from-brand-50 via-white to-slate-100">
  <div class="container auth-reset-container">
    <section class="auth-card-modern auth-reset-card rounded-3xl border border-white bg-white/95 shadow-2xl shadow-slate-900/10 backdrop-blur" data-reveal>
      <a href="{{ route('home') }}" class="auth-brand"><img src="{{ asset('img/car-findal-mark.svg') }}" alt=""><span>Car Findal</span></a>
      <span class="experience-eyebrow">BACK ON THE ROAD</span><h1>Reset your password.</h1><p class="auth-intro">Enter the email address linked to your account and we’ll send a reset link if one is available.</p>
      <form action="{{ route('password.email') }}" method="POST" class="auth-modern-form">@csrf
        <label>Email address<input name="email" value="{{ old('email') }}" placeholder="you@example.com" type="email" autocomplete="email" required></label>
        <button class="auth-submit-button" type="submit">Send reset link <span>→</span></button>
      </form>
      <p class="auth-switch-link"><a href="{{ route('login') }}">← Back to sign in</a></p>
    </section>
  </div>
</div>
@endsection
