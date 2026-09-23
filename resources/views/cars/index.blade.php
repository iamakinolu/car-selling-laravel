@extends('layouts.app')
@section('content')
<div class="container">
  <div class="sm:flex items-center justify-between mb-medium">
    <div><h1>Find Cars</h1><p class="text-muted">{{ $cars->total() }} cars found</p></div>
  </div>
  <form method="GET" action="{{ route('cars.index') }}" class="card p-medium mb-large">
    <div class="grid grid-cols-3 gap-1">
      <div class="form-group"><label>Maker</label><input name="maker" value="{{ request('maker') }}" placeholder="e.g. Lexus"></div>
      <div class="form-group"><label>Model</label><input name="model" value="{{ request('model') }}" placeholder="e.g. RX200t"></div>
      <div class="form-group"><label>Car Type</label><select name="car_type"><option value="">Any</option>@foreach(['sedan','hatchback','suv'] as $type)<option value="{{ $type }}" @selected(request('car_type')===$type)>{{ ucfirst($type) }}</option>@endforeach</select></div>
      <div class="form-group"><label>Fuel</label><select name="fuel_type"><option value="">Any</option>@foreach(['gasoline','diesel','electric','hybrid'] as $fuel)<option value="{{ $fuel }}" @selected(request('fuel_type')===$fuel)>{{ ucfirst($fuel) }}</option>@endforeach</select></div>
      <div class="form-group"><label>Year From</label><input type="number" name="year_from" value="{{ request('year_from') }}"></div>
      <div class="form-group"><label>Year To</label><input type="number" name="year_to" value="{{ request('year_to') }}"></div>
      <div class="form-group"><label>Price From</label><input type="number" name="price_from" value="{{ request('price_from') }}"></div>
      <div class="form-group"><label>Price To</label><input type="number" name="price_to" value="{{ request('price_to') }}"></div>
      <div class="form-group"><label>Max Mileage</label><input type="number" name="mileage" value="{{ request('mileage') }}"></div>
    </div>
    <button class="btn btn-primary" type="submit">Search</button>
    <a class="btn btn-default" href="{{ route('cars.index') }}">Reset</a>
  </form>
  <div class="car-items-listing">
    @forelse($cars as $car) @include('partials.car-card') @empty
      <div class="card p-large text-center w-full"><h2>No cars match your search.</h2></div>
    @endforelse
  </div>
  <div class="my-large">{{ $cars->links() }}</div>
</div>
@endsection