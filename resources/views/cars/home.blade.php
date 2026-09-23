@extends('layouts.app')
@section('content')
<section class="hero">
  <div class="container">
    <div class="hero-content">
      <div>
        <h1>Find your next car.</h1>
        <p>Search thousands of cars and find the one that fits you.</p>
        <a class="btn btn-primary" href="{{ route('cars.index') }}">Browse Cars</a>
      </div>
      <img src="{{ asset('img/car-png-39071.png') }}" alt="Car" class="hero-image">
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="flex items-center justify-between mb-medium">
      <h2>Latest Cars</h2>
      <a href="{{ route('cars.index') }}">View all →</a>
    </div>
    @if($cars->count())
      <div class="car-items-listing">@foreach($cars as $car) @include('partials.car-card') @endforeach</div>
    @else
      <div class="card p-large text-center"><h2>No cars listed yet</h2><p>Be the first to list a car.</p><a href="{{ auth()->check() ? route('cars.create') : route('signup') }}" class="btn btn-primary">List a Car</a></div>
    @endif
  </div>
</section>
@endsection