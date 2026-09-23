@extends('layouts.app')
@section('content')
<div class="container">
  <div class="car-detail">
    <div class="car-images-carousel card">
      <img id="activeImage" class="car-detail-main-image" src="{{ $car->primary_image_url }}" alt="">
      @if($car->images->count())
      <div class="car-image-thumbnails">
        @foreach($car->images as $image)<img src="{{ asset('storage/'.$image->path) }}" alt="" class="{{ $loop->first ? 'active-thumbnail' : '' }}">@endforeach
      </div>
      @endif
    </div>
    <div class="card p-large">
      <div class="flex items-center justify-between"><span class="car-item-badge">{{ strtoupper($car->car_type) }}</span><span>{{ $car->year }}</span></div>
      <h1>{{ $car->maker }} {{ $car->model }}</h1>
      <p class="car-item-price">${{ number_format($car->price,0) }}</p>
      <hr>
      <p><strong>Fuel:</strong> {{ ucfirst($car->fuel_type) }}</p>
      <p><strong>Mileage:</strong> {{ number_format($car->mileage) }} miles</p>
      <p><strong>Location:</strong> {{ $car->city }}, {{ $car->state }}</p>
      @if($car->description)<p>{{ $car->description }}</p>@endif
      @if($car->features)<h3>Features</h3><div class="features-list">@foreach($car->features as $feature)<span class="car-item-badge">{{ ucwords(str_replace('_',' ',$feature)) }}</span>@endforeach</div>@endif
      @auth
      <form method="POST" action="{{ route('cars.watchlist',$car) }}" class="my-medium">@csrf<button class="btn btn-primary w-full">♥ Add / Remove Favourite</button></form>
      @endauth
    </div>
  </div>
</div>
@endsection