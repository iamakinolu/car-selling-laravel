@extends('layouts.app')
@section('content')
<div class="experience-page dashboard-page">
  <section class="dashboard-banner"><div class="container dashboard-banner-content" data-reveal><div><span class="experience-eyebrow">YOUR SELLER SPACE</span><h1>My listings</h1><p>Keep your cars up to date and ready for their next owner.</p></div><a href="{{ route('cars.create') }}" class="experience-primary-button"><span>＋</span> List a car</a><div class="dashboard-banner-orbit" aria-hidden="true">↗</div></div></section>
  <div class="container dashboard-content">
    <div class="dashboard-summary" data-reveal><div><span>YOUR INVENTORY</span><strong>{{ $cars->total() }}</strong><small>{{ $cars->total() === 1 ? 'car listed' : 'cars listed' }}</small></div><div class="dashboard-summary-note"><span class="dashboard-summary-icon">✦</span><p>Listings with clear details and photos help buyers make confident decisions.</p></div></div>
    @if($cars->count())
      <div class="dashboard-listings-heading"><div><h2>All your cars</h2><p>Manage photos, details, and visibility.</p></div><span>{{ $cars->firstItem() }}–{{ $cars->lastItem() }} of {{ $cars->total() }}</span></div>
      <div class="dashboard-listing-stack">
        @foreach($cars as $car)
          <article class="dashboard-listing-card" data-reveal data-reveal-delay="{{ min($loop->index * 65, 260) }}">
            <a href="{{ route('cars.show',$car) }}" class="dashboard-listing-image"><img src="{{ $car->primary_image_url }}" alt="{{ $car->year }} {{ $car->maker }} {{ $car->model }}"><span>{{ $car->images->count() }} {{ $car->images->count() === 1 ? 'photo' : 'photos' }}</span></a>
            <div class="dashboard-listing-info"><div class="dashboard-listing-topline"><span class="dashboard-status {{ $car->published ? 'is-published' : 'is-draft' }}"><i></i>{{ $car->published ? 'Published' : 'Draft' }}</span><span>{{ $car->year }} · {{ ucfirst($car->car_type) }}</span></div><h3><a href="{{ route('cars.show',$car) }}">{{ $car->maker }} {{ $car->model }}</a></h3><p>{{ $car->city ?: ($car->state ?: 'Location not set') }} <span>·</span> {{ number_format($car->mileage) }} mi</p><strong class="dashboard-listing-price">₦{{ number_format($car->price,0) }}</strong></div>
            <div class="dashboard-listing-actions"><a href="{{ route('cars.edit',$car) }}" class="dashboard-action-edit">Edit listing</a><a href="{{ route('cars.images',$car) }}" class="dashboard-action-photos">Photos</a><form method="POST" action="{{ route('cars.destroy',$car) }}" onsubmit="return confirm('Delete this car listing?')">@csrf @method('DELETE')<button type="submit" class="dashboard-action-delete" aria-label="Delete {{ $car->maker }} {{ $car->model }}">Delete</button></form></div>
          </article>
        @endforeach
      </div>
      <div class="experience-pagination">{{ $cars->links() }}</div>
    @else
      <div class="experience-empty dashboard-empty" data-reveal><span class="experience-empty-icon">⌁</span><span class="experience-eyebrow">A FRESH START</span><h2>Your first listing starts here.</h2><p>Add a few details and photos to introduce your car to shoppers.</p><a href="{{ route('cars.create') }}" class="experience-primary-button">Create your first listing <span>→</span></a></div>
    @endif
  </div>
</div>
@endsection
