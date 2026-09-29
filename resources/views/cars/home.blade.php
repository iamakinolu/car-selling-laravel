@extends('layouts.app')
@section('content')
<div class="home-page">
  <section class="home-hero bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800 py-20 md:py-28">
    <div class="container home-hero-grid">
      <div class="home-hero-copy" data-reveal>
        <span class="home-eyebrow"><span></span> YOUR NEXT DRIVE STARTS HERE</span>
        <h1>Good cars.<br><em>Good decisions.</em></h1>
        <p>Find a car that fits your life, your plans, and your budget. Browse real listings and connect directly with sellers.</p>
        <div class="home-hero-actions">
          <a class="home-button home-button-primary" href="{{ route('cars.index') }}">Explore cars <span aria-hidden="true">↗</span></a>
          <a class="home-button home-button-quiet" href="{{ auth()->check() ? route('cars.create') : route('signup') }}">Sell your car <span aria-hidden="true">→</span></a>
        </div>
        <div class="home-hero-note"><span class="home-note-icon">✓</span> Browse at your own pace. Talk to sellers directly.</div>
      </div>
      <div class="home-hero-visual rounded-[2rem]" data-reveal data-reveal-delay="120">
        <div class="home-hero-stage" data-depth-scene>
          <div class="home-hero-glow"></div>
          <div class="home-hero-orbit home-hero-orbit-one"></div>
          <div class="home-hero-orbit home-hero-orbit-two"></div>
          <div class="home-hero-photo-frame"><img class="home-hero-car" src="{{ asset('img/cars/Lexus-RX200t-2016/2.jpeg') }}" alt="Brown Lexus RX200t viewed from the front side" fetchpriority="high"></div>
          <div class="home-hero-spec"><span class="home-spec-dot"></span><span>THE ROAD AHEAD<br><strong>Looks good on you.</strong></span><span class="home-spec-arrow" aria-hidden="true">&#8599;</span></div>
          <div class="home-visual-label"><span>MAKE YOUR NEXT MOVE</span><strong>Find the one<br>that feels right.</strong></div>
          <div class="home-visual-index"><span>01</span><i></i><span>YOUR JOURNEY</span></div>
        </div>
      </div>
    </div>
    <div class="home-hero-bottom" aria-hidden="true"><span>FIND</span><span>COMPARE</span><span>DRIVE</span></div>
  </section>

  <section class="home-search-wrap" aria-label="Search cars">
    <form class="home-search container rounded-2xl border border-white/80 md:rounded-3xl" method="GET" action="{{ route('cars.index') }}" data-reveal>
      <div class="home-search-intro"><span class="home-search-mark">⌕</span><div><strong>Start your search</strong><small>What are you looking for?</small></div></div>
      <label><span>Make or model</span><input type="text" name="q" placeholder="e.g. Toyota, Lexus"></label>
      <label><span>Body style</span><select name="car_type"><option value="">Any type</option><option value="sedan">Sedan</option><option value="suv">SUV</option><option value="hatchback">Hatchback</option></select></label>
      <button class="home-search-button" type="submit">Find a car <span aria-hidden="true">→</span></button>
    </form>
  </section>

  <section class="home-inventory home-section">
    <div class="container">
      <div class="home-section-heading" data-reveal>
        <div><span class="home-eyebrow">A GOOD PLACE TO START</span><h2>Fresh on the market</h2><p>Take a look at the latest cars listed by our community.</p></div>
        <a class="home-text-link" href="{{ route('cars.index') }}">See all cars <span aria-hidden="true">↗</span></a>
      </div>
      @if($cars->count())
        <div class="car-items-listing home-car-listing">@foreach($cars as $car)<div data-reveal data-reveal-delay="{{ min($loop->index * 70, 350) }}">@include('partials.car-card')</div>@endforeach</div>
      @else
        <div class="home-empty-state" data-reveal><span class="home-empty-icon">✳</span><div><h3>The road is open.</h3><p>There are no cars listed yet. Be the first to share yours.</p></div><a class="home-button home-button-primary" href="{{ auth()->check() ? route('cars.create') : route('signup') }}">List the first car <span aria-hidden="true">→</span></a></div>
      @endif
    </div>
  </section>

  <section class="home-guide home-section" id="how-it-works">
    <div class="container">
      <div class="home-section-heading home-guide-heading" data-reveal>
        <div><span class="home-eyebrow">MADE TO FEEL SIMPLE</span><h2>From looking to driving.</h2><p>A clear path to your next set of keys.</p></div>
      </div>
      <div class="home-steps">
        <article class="home-step" data-reveal><span class="home-step-number">01</span><span class="home-step-icon">⌕</span><h3>Find your shortlist</h3><p>Search by make, model, or body style, then explore the listings that catch your eye.</p></article>
        <article class="home-step" data-reveal data-reveal-delay="100"><span class="home-step-number">02</span><span class="home-step-icon">◇</span><h3>Get the details</h3><p>Review photos, mileage, features, and location so you know what each car offers.</p></article>
        <article class="home-step" data-reveal data-reveal-delay="200"><span class="home-step-number">03</span><span class="home-step-icon">↗</span><h3>Talk to the seller</h3><p>Contact the seller directly to ask questions, arrange a viewing, and take the next step.</p></article>
      </div>
    </div>
  </section>

  <section class="home-seller-section">
    <div class="container home-seller-panel rounded-3xl shadow-2xl shadow-slate-900/15" data-reveal>
      <div class="home-seller-art" aria-hidden="true"><span class="home-seller-orbit"></span><span class="home-seller-arrow">↗</span></div>
      <div class="home-seller-copy"><span class="home-eyebrow">READY FOR A NEW OWNER?</span><h2>Your car has a next chapter.</h2><p>Create a listing, add the details and photos, and connect with people looking for their next car.</p><a class="home-button home-button-light" href="{{ auth()->check() ? route('cars.create') : route('signup') }}">List your car <span aria-hidden="true">→</span></a></div>
    </div>
  </section>
</div>
@endsection
