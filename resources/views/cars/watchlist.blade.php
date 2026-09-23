@extends('layouts.app')
@section('content')
<div class="container"><h1>My Favourite Cars</h1>
  <div class="car-items-listing">
    @forelse($cars as $car) @include('partials.car-card') @empty
      <div class="card p-large text-center w-full"><h2>Your watchlist is empty.</h2><a href="{{ route('cars.index') }}" class="btn btn-primary">Browse Cars</a></div>
    @endforelse
  </div>
  <div class="my-large">{{ $cars->links() }}</div>
</div>
@endsection