<div class="car-item card group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-slate-900/10">
  <a class="block overflow-hidden" href="{{ route('cars.show', $car) }}">
    <img class="car-item-img w-full object-cover transition duration-700 group-hover:scale-105" src="{{ $car->primary_image_url }}" alt="{{ $car->maker }} {{ $car->model }}" loading="lazy">
  </a>
  <div class="p-medium p-4 sm:p-5">
    <div class="flex items-center justify-between gap-3">
      <small class="m-0 inline-flex min-w-0 items-center gap-1.5 truncate text-xs font-medium text-slate-500"><span class="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-500"></span>{{ $car->city ?: ($car->state ?: 'Location not set') }}</small>
      @auth
      <form method="POST" action="{{ route('cars.watchlist', $car) }}">
        @csrf
        @php($isSaved = auth()->user()->watchlistCars()->whereKey($car->id)->exists())
        <button class="btn-heart inline-grid h-10 w-10 place-items-center rounded-full border border-slate-200 bg-white text-lg text-slate-500 shadow-sm transition hover:scale-110 hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 {{ $isSaved ? 'text-primary' : '' }}" aria-label="{{ $isSaved ? 'Remove from favourites' : 'Add to favourites' }}" aria-pressed="{{ $isSaved ? 'true' : 'false' }}" title="{{ $isSaved ? 'Remove from favourites' : 'Add to favourites' }}">&#9829;</button>
      </form>
      @endauth
    </div>
    <h2 class="car-item-title mt-4 font-bold tracking-tight text-slate-900">{{ $car->year }} - {{ $car->maker }} {{ $car->model }}</h2>
    <p class="car-item-price font-extrabold tracking-tight text-brand-600">₦{{ number_format($car->price, 0) }}</p>
    <hr>
    <p class="m-0 flex flex-wrap gap-1.5">
      <span class="car-item-badge rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-600">{{ strtoupper($car->car_type) }}</span>
      <span class="car-item-badge rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-600">{{ ucfirst($car->fuel_type) }}</span>
      <span class="car-item-badge rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-600">{{ number_format($car->mileage) }} mi</span>
    </p>
  </div>
</div>
