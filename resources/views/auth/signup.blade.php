@extends('layouts.app')
@section('content')
<div class="auth-experience auth-signup-page bg-gradient-to-br from-brand-50 via-white to-slate-100">
  <div class="auth-layout container">
    <section class="auth-card-modern rounded-3xl border border-white bg-white/95 shadow-2xl shadow-slate-900/10 backdrop-blur" data-reveal>
      <a href="{{ route('home') }}" class="auth-brand"><img src="{{ asset('img/car-findal-mark.svg') }}" alt=""><span>Car Findal</span></a>
      <span class="experience-eyebrow">JOIN THE JOURNEY</span><h1>Let’s get you started.</h1><p class="auth-intro">Create an account to save favourites and share your car with shoppers.</p>
      <form action="{{ route('signup.store') }}" method="POST" class="auth-modern-form">@csrf
        <div class="auth-input-pair"><label>First name<input name="first_name" value="{{ old('first_name') }}" placeholder="First name" autocomplete="given-name" required></label><label>Last name<input name="last_name" value="{{ old('last_name') }}" placeholder="Last name" autocomplete="family-name" required></label></div>
        <label>Email address<input name="email" value="{{ old('email') }}" placeholder="you@example.com" type="email" autocomplete="email" required></label>
        <label>Phone <span class="auth-optional">Optional</span><input name="phone" value="{{ old('phone') }}" placeholder="Your phone number" type="tel" autocomplete="tel"></label>
        <div class="auth-input-pair"><label>Password<input name="password" placeholder="At least 8 characters" type="password" autocomplete="new-password" required></label><label>Confirm password<input name="password_confirmation" placeholder="Repeat password" type="password" autocomplete="new-password" required></label></div>
        <button class="auth-submit-button" type="submit">Create account <span>→</span></button>
      </form>
      <p class="auth-switch-link">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
    </section>
    <aside class="auth-story-panel" data-reveal data-reveal-delay="120"><span class="auth-story-kicker">A MARKETPLACE THAT MOVES WITH YOU</span><div class="auth-story-copy"><span>YOUR NEXT<br><em>CHAPTER STARTS.</em></span><p>Keep your shortlist close. Put your car in front of the right eyes.</p></div><img src="{{ asset('img/cars/Lexus-RX200t-2016/1.jpeg') }}" alt="A car ready for a new owner"><span class="auth-story-index">CAR FINDAL <i>✦</i></span></aside>
  </div>
</div>
@endsection
