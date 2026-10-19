@extends('layouts.app')
@section('content')
<div class="about-page">
  <section class="about-hero">
    <div class="container mx-auto max-w-7xl px-5 py-20 md:px-8 md:py-28">
      <div class="about-hero-copy">
        <span class="experience-eyebrow">ABOUT SHOWBOY MOTORS</span>
        <h1>Good journeys start with the right car.</h1>
        <p>Finding a car should feel clear and straightforward. Showboy Motors brings vehicle listings and the people behind them together, so you can explore your options and take the next step with confidence.</p>
        <a class="experience-primary-button" href="{{ route('cars.index') }}">Explore available cars <span aria-hidden="true">→</span></a>
      </div>
      <div class="about-hero-art" aria-hidden="true"><span class="about-art-ring"></span><span class="about-art-mark">S</span><span class="about-art-caption">THE ROAD AHEAD<br><strong>STARTS HERE</strong></span></div>
    </div>
  </section>
  <section class="container mx-auto max-w-7xl px-5 py-16 md:px-8 md:py-20">
    <div class="about-content-grid">
      <div><span class="experience-eyebrow">A CLEARER WAY TO SHOP</span><h2>Make your next move with clarity.</h2></div>
      <div class="about-content-copy"><p>Whether you’re comparing your options or ready to get in touch with a seller, we make the essentials easy to find. Browse listings, review the details, and decide what works for you.</p><p>Our aim is simple: make it easier for buyers and sellers to connect around their next car.</p></div>
    </div>
    <div class="about-steps">
      <article><span>01</span><h3>Explore</h3><p>Browse cars and discover listings that fit what you’re looking for.</p></article>
      <article><span>02</span><h3>Compare</h3><p>Review the vehicle details and shortlist the options that feel right.</p></article>
      <article><span>03</span><h3>Connect</h3><p>Reach out to the seller directly to ask questions and plan your next step.</p></article>
    </div>
  </section>
  <section class="about-cta"><div class="container mx-auto flex max-w-7xl flex-col items-start justify-between gap-6 px-5 py-12 md:flex-row md:items-center md:px-8"><div><span class="experience-eyebrow">YOUR NEXT CHAPTER</span><h2>Ready to find your next car?</h2></div><a class="experience-outline-button" href="{{ route('cars.index') }}">Browse cars <span aria-hidden="true">→</span></a></div></section>
</div>
@endsection
