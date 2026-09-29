@extends('layouts.app')
@section('content')
<div class="browse-page bg-gradient-to-b from-slate-100 to-white">
  <section class="browse-banner bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800">
    <div class="container browse-banner-inner" data-reveal>
      <div><span class="browse-eyebrow"><span></span> THE RIGHT CAR IS OUT THERE</span><h1>Find your next car.</h1><p>Explore the latest listings and narrow in on the details that matter to you.</p></div>
      <div class="browse-banner-art" aria-hidden="true"><span class="browse-art-ring browse-art-ring-one"></span><span class="browse-art-ring browse-art-ring-two"></span><span class="browse-art-mark">↗</span><span class="browse-art-caption">YOUR NEXT<br>CHAPTER</span></div>
      <span class="browse-banner-index" aria-hidden="true">01 <i></i> EXPLORE</span>
    </div>
  </section>

  <main class="container browse-content">
    <div class="browse-layout">
      <aside class="browse-sidebar" data-reveal>
        <form method="GET" action="{{ route('cars.index') }}" class="browse-filter-form rounded-3xl border border-slate-200 shadow-xl shadow-slate-900/5">
          <div class="browse-filter-heading"><div><span class="browse-eyebrow">MAKE IT YOURS</span><h2>Refine search</h2></div><span class="browse-filter-icon">☷</span></div>
          <label class="browse-field"><span>Make or model</span><input type="search" name="q" value="{{ request('q') }}" placeholder="Try Toyota or Corolla"></label>
          <div class="browse-field-row">
            <label class="browse-field"><span>Maker</span><input name="maker" value="{{ request('maker') }}" placeholder="e.g. Lexus"></label>
            <label class="browse-field"><span>Model</span><input name="model" value="{{ request('model') }}" placeholder="e.g. RX"></label>
          </div>
          <label class="browse-field"><span>Body style</span><select name="car_type"><option value="">Any body style</option>@foreach(['sedan','hatchback','suv'] as $type)<option value="{{ $type }}" @selected(request('car_type')===$type)>{{ ucfirst($type) }}</option>@endforeach</select></label>
          <label class="browse-field"><span>Fuel type</span><select name="fuel_type"><option value="">Any fuel type</option>@foreach(['gasoline','diesel','electric','hybrid'] as $fuel)<option value="{{ $fuel }}" @selected(request('fuel_type')===$fuel)>{{ ucfirst($fuel) }}</option>@endforeach</select></label>
          <div class="browse-filter-divider"></div>
          <div class="browse-filter-section-title">Year</div>
          <div class="browse-field-row">
            <label class="browse-field"><span>From</span><input type="number" name="year_from" value="{{ request('year_from') }}" placeholder="2018"></label>
            <label class="browse-field"><span>To</span><input type="number" name="year_to" value="{{ request('year_to') }}" placeholder="2026"></label>
          </div>
          <div class="browse-filter-section-title">Price range</div>
          <div class="browse-field-row">
            <label class="browse-field"><span>Minimum</span><input type="number" name="price_from" value="{{ request('price_from') }}" placeholder="0"></label>
            <label class="browse-field"><span>Maximum</span><input type="number" name="price_to" value="{{ request('price_to') }}" placeholder="Any"></label>
          </div>
          <label class="browse-field"><span>Maximum mileage</span><input type="number" name="mileage" value="{{ request('mileage') }}" placeholder="Any mileage"></label>
          <div class="browse-filter-actions"><button type="submit" class="browse-submit">Apply filters <span>→</span></button><a href="{{ route('cars.index') }}">Clear filters</a></div>
        </form>
        <div class="browse-seller-note"><span class="browse-note-icon">✦</span><div><strong>Selling your car?</strong><p>Put your listing in front of people searching for their next drive.</p><a href="{{ auth()->check() ? route('cars.create') : route('signup') }}">Create a listing <span>↗</span></a></div></div>
      </aside>

      <section class="browse-results" aria-label="Car search results">
        <div class="browse-results-heading" data-reveal>
          <div><span class="browse-eyebrow">YOUR SHORTLIST STARTS HERE</span><h2>Cars for you</h2><p>{{ number_format($cars->total()) }} {{ $cars->total() === 1 ? 'car' : 'cars' }} to explore</p></div>
          <div class="browse-results-count"><strong>{{ str_pad((string) $cars->total(), 2, '0', STR_PAD_LEFT) }}</strong><span>RESULTS</span></div>
        </div>
        @if($cars->count())
          <div class="browse-car-grid">@foreach($cars as $car)<article class="browse-car-item" data-reveal data-reveal-delay="{{ min($loop->index * 65, 325) }}">@include('partials.car-card')</article>@endforeach</div>
          <div class="browse-pagination">{{ $cars->links() }}</div>
        @else
          <div class="browse-empty" data-reveal><span class="browse-empty-icon">⌕</span><h3>No cars found this time.</h3><p>Try broadening your search or clearing a few filters. Your next great find may be just around the corner.</p><a href="{{ route('cars.index') }}" class="browse-submit">Show all cars <span>→</span></a></div>
        @endif
      </section>
    </div>
  </main>
</div>
@endsection
