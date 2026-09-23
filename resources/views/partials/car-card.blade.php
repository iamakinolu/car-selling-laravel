<div class="car-item card">
  <a href="{{ route('cars.show', $car) }}">
    <img class="car-item-img rounded-t" src="{{ $car->primary_image_url }}" alt="{{ $car->maker }} {{ $car->model }}">
  </a>
  <div class="p-medium">
    <div class="flex items-center justify-between">
      <small class="m-0 text-muted">{{ $car->city ?: ($car->state ?: 'Location not set') }}</small>
      @auth
      <form method="POST" action="{{ route('cars.watchlist', $car) }}">
        @csrf
        <button class="btn-heart {{ auth()->user()->watchlistCars()->whereKey($car->id)->exists() ? 'text-primary' : '' }}" title="Favourite">♥</button>
      </form>
      @endauth
    </div>
    <h2 class="car-item-title">{{ $car->year }} - {{ $car->maker }} {{ $car->model }}</h2>
    <p class="car-item-price">${{ number_format($car->price, 0) }}</p>
    <hr>
    <p class="m-0">
      <span class="car-item-badge">{{ strtoupper($car->car_type) }}</span>
      <span class="car-item-badge">{{ ucfirst($car->fuel_type) }}</span>
      <span class="car-item-badge">{{ number_format($car->mileage) }} mi</span>
    </p>
  </div>
</div>