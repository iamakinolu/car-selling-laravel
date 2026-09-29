@extends('layouts.app')
@section('content')
<div class="experience-page car-show-page">
  <div class="container car-show-container">
    <nav class="detail-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><a href="{{ route('cars.index') }}">Cars</a><span>/</span><span>{{ $car->maker }} {{ $car->model }}</span></nav>
    <header class="detail-page-heading" data-reveal><div><span class="experience-eyebrow">{{ strtoupper($car->car_type) }} · {{ $car->year }}</span><h1>{{ $car->maker }} <span>{{ $car->model }}</span></h1><p><span>⌖</span> {{ $car->city ?: 'Location not set' }}{{ $car->state ? ', '.$car->state : '' }}</p></div><span class="detail-listing-mark">CAR FINDAL <i>✦</i></span></header>
    <div class="detail-layout">
      <section class="detail-gallery-card overflow-hidden rounded-3xl border border-slate-200 shadow-xl shadow-slate-900/5" aria-label="Car photos" data-reveal>
        <div class="detail-image-stage"><img id="activeImage" src="{{ $car->primary_image_url }}" alt="{{ $car->year }} {{ $car->maker }} {{ $car->model }}"><span class="detail-photo-count"><i>▧</i> <span id="activePhotoNumber">01</span> / {{ str_pad((string)max($car->images->count(),1),2,'0',STR_PAD_LEFT) }}</span></div>
      </section>
      <section class="detail-info-card rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5" data-reveal data-reveal-delay="100">
        <div class="detail-info-topline"><span class="detail-condition-badge">{{ ucfirst($car->fuel_type) }}</span><span class="detail-year-label">MODEL YEAR <strong>{{ $car->year }}</strong></span></div>
        <p class="detail-price-label">ASKING PRICE</p><p class="detail-price">₦{{ number_format($car->price,0) }}</p>
        <div class="detail-spec-grid"><div><span>BODY STYLE</span><strong>{{ ucfirst($car->car_type) }}</strong></div><div><span>MILEAGE</span><strong>{{ number_format($car->mileage) }} mi</strong></div><div><span>FUEL</span><strong>{{ ucfirst($car->fuel_type) }}</strong></div><div><span>LOCATION</span><strong>{{ $car->city ?: ($car->state ?: 'Not set') }}</strong></div></div>
        @if($car->description)<div class="detail-description"><h2>About this car</h2><p>{{ $car->description }}</p></div>@endif
        @if($car->features)<div class="detail-feature-list"><h2>Features</h2><div>@foreach($car->features as $feature)<span><i>✓</i>{{ ucwords(str_replace('_',' ',$feature)) }}</span>@endforeach</div></div>@endif
        <div class="detail-seller-card"><span class="detail-seller-avatar">{{ mb_strtoupper(mb_substr($car->user->name ?? 'S',0,1)) }}</span><div><small>LISTED BY</small><strong>{{ $car->user->name ?? 'Car seller' }}</strong><a href="mailto:{{ $car->user->email ?? '' }}">Contact seller <span>↗</span></a></div></div>
        <div class="detail-card-actions"><a href="mailto:{{ $car->user->email ?? '' }}?subject={{ rawurlencode('Question about '.$car->year.' '.$car->maker.' '.$car->model) }}" class="detail-contact-button">Contact seller <span>→</span></a>
          @auth<form method="POST" action="{{ route('cars.watchlist',$car) }}">@csrf<button type="submit" class="detail-save-button" aria-label="Save car to favourites">♡</button></form>@else<a class="detail-save-button" href="{{ route('login') }}" aria-label="Log in to save this car">♡</a>@endauth
        </div>
      </section>
    </div>
    @if($car->images->count())
      <div class="detail-thumbnails car-image-thumbnails" aria-label="Choose a car photo">@foreach($car->images as $image)<button type="button" class="{{ $loop->first ? 'active-thumbnail' : '' }}" data-image-src="{{ asset('storage/'.$image->path) }}" data-image-number="{{ str_pad((string)$loop->iteration,2,'0',STR_PAD_LEFT) }}" aria-label="Show photo {{ $loop->iteration }}"><img src="{{ asset('storage/'.$image->path) }}" alt=""></button>@endforeach</div>
    @endif
    <div class="detail-bottom-note"><span>CAR FINDAL</span><i></i><p>Take your time, ask questions, and make the choice that feels right for you.</p></div>
  </div>
</div>
@endsection
