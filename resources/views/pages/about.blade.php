@extends('layouts.app')
@section('content')
<div class="about-page">
  <section class="about-hero">
    <div class="container about-hero-inner mx-auto max-w-7xl px-5 md:px-8">
      <div class="about-hero-copy">
        <span class="experience-eyebrow">ABOUT SHOWBOY MOTORS</span>
        <h1>A clearer way to find your next car.</h1>
        <p>We bring car listings and the people behind them together, making it easier to explore your options, compare the details, and contact a seller directly.</p>
        <a class="experience-primary-button" href="{{ route('cars.index') }}">Browse cars <span aria-hidden="true">&rarr;</span></a>
      </div>
      <div class="about-hero-visual">
        <img src="{{ asset('img/cars/Lexus-RX200t-2016/2.jpeg') }}" alt="Lexus RX200t available to explore" fetchpriority="high">
        <div class="about-hero-caption"><span class="about-caption-dot"></span><div><small>YOUR NEXT JOURNEY</small><strong>Starts with a good choice.</strong></div></div>
        <span class="about-visual-index" aria-hidden="true">SHOWBOY MOTORS <i> / </i> 01</span>
      </div>
    </div>
  </section>

  <section class="about-intro-section">
    <div class="container mx-auto max-w-7xl px-5 py-16 md:px-8 md:py-20">
      <div class="about-intro-heading"><span class="experience-eyebrow">A MARKETPLACE BUILT AROUND YOU</span><h2>Make your next move with confidence.</h2></div>
      <div class="about-intro-copy"><p>Choosing a car is a big decision. We want the search to feel straightforward: useful listing details, clear photos, and a direct way to reach the seller.</p><p>Showboy Motors gives buyers a place to discover cars and gives sellers a simple way to put their listings in front of people looking.</p></div>
      <div class="about-benefit-row">
        <article><span class="about-benefit-number">01</span><div><h3>Explore with ease</h3><p>Search listings and use filters to narrow down the cars that suit you.</p></div></article>
        <article><span class="about-benefit-number">02</span><div><h3>Compare the details</h3><p>Review photos, mileage, features, price, and location in one place.</p></div></article>
        <article><span class="about-benefit-number">03</span><div><h3>Talk to the seller</h3><p>Reach out directly to ask questions and arrange your next step.</p></div></article>
      </div>
    </div>
  </section>

  <section class="about-purpose-section">
    <div class="container about-purpose-grid mx-auto max-w-7xl px-5 py-16 md:px-8 md:py-20">
      <article><span class="experience-eyebrow">OUR MISSION</span><h2>Make car shopping feel simpler.</h2><p>We’re here to make it easier for people to find the information they need, discover available cars, and connect with sellers.</p></article>
      <article><span class="experience-eyebrow">OUR APPROACH</span><h2>Keep the important details close.</h2><p>From the first search to the conversation with a seller, we focus on a clear experience that helps you make your own informed choice.</p></article>
    </div>
  </section>

  <section class="about-cta"><div class="container mx-auto flex max-w-7xl flex-col items-start justify-between gap-6 px-5 py-12 md:flex-row md:items-center md:px-8 md:py-14"><div><span class="experience-eyebrow">YOUR NEXT CHAPTER</span><h2>Ready to find your next car?</h2><p>Start exploring the cars listed on Showboy Motors.</p></div><a class="experience-outline-button" href="{{ route('cars.index') }}">Explore cars <span aria-hidden="true">&rarr;</span></a></div></section>
</div>
@endsection
