@extends('layouts.app')
@section('content')
<div class="experience-page watchlist-page">
  <section class="dashboard-banner watchlist-banner"><div class="container dashboard-banner-content" data-reveal><div><span class="experience-eyebrow">KEEP THE GOOD ONES CLOSE</span><h1>My favourites</h1><p>Cars you’ve saved, all in one place.</p></div><a href="{{ route('cars.index') }}" class="experience-outline-button">Explore cars <span>↗</span></a><div class="dashboard-banner-orbit" aria-hidden="true">♡</div></div></section>
  <div class="container dashboard-content">
    @if($cars->count())
      <div class="watchlist-intro" data-reveal><div><h2>Your saved cars</h2><p>Come back any time to compare details and photos.</p></div><span>{{ $cars->total() }} {{ $cars->total() === 1 ? 'saved car' : 'saved cars' }}</span></div>
      <div class="experience-car-grid">@foreach($cars as $car)<article data-reveal data-reveal-delay="{{ min($loop->index * 65, 260) }}">@include('partials.car-card')</article>@endforeach</div>
      <div class="experience-pagination">{{ $cars->links() }}</div>
    @else
      <div class="experience-empty" data-reveal><span class="experience-empty-icon">♡</span><span class="experience-eyebrow">YOUR NEXT FAVOURITE IS OUT THERE</span><h2>Nothing saved just yet.</h2><p>When a car catches your eye, save it here so it’s easy to find again.</p><a href="{{ route('cars.index') }}" class="experience-primary-button">Browse cars <span>→</span></a></div>
    @endif
  </div>
</div>
@endsection
