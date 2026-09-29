@extends('layouts.app')
@section('content')
<div class="auth-experience bg-gradient-to-br from-brand-50 via-white to-slate-100">
  <div class="auth-layout container">
    <section class="auth-card-modern rounded-3xl border border-white bg-white/95 shadow-2xl shadow-slate-900/10 backdrop-blur" data-reveal>
      <a href="{{ route('home') }}" class="auth-brand"><img src="{{ asset('img/car-findal-mark.svg') }}" alt=""><span>Car Findal</span></a>
      <span class="experience-eyebrow">GOOD TO SEE YOU AGAIN</span><h1>Welcome back.</h1><p class="auth-intro">Sign in to manage your listings and saved cars.</p>
      <form action="{{ route('login.store') }}" method="POST" class="auth-modern-form">@csrf
        <label>Email address<input name="email" value="{{ old('email') }}" placeholder="you@example.com" type="email" autocomplete="email" required></label>
        <label>Password<input name="password" placeholder="Your password" type="password" autocomplete="current-password" required></label>
        <div class="auth-form-options"><label class="auth-remember"><input type="checkbox" name="remember" value="1"> Remember me</label><a href="{{ route('password.request') }}">Forgot password?</a></div>
        <button class="auth-submit-button" type="submit">Sign in <span>→</span></button>
      </form>
      <p class="auth-switch-link">New to Car Findal? <a href="{{ route('signup') }}">Create an account</a></p>
    </section>
    <aside class="auth-story-panel" data-reveal data-reveal-delay="120"><span class="auth-story-kicker">THE NEXT DRIVE IS YOURS</span><div class="auth-story-copy"><span>FIND YOUR<br><em>WAY FORWARD.</em></span><p>Come back to your shortlist, your cars, and what’s next.</p></div><img src="{{ asset('img/cars/Lexus-RX200t-2016/1.jpeg') }}" alt="A car ready for its next drive"><span class="auth-story-index">CAR FINDAL <i>✦</i></span></aside>
  </div>
</div>
@endsection
