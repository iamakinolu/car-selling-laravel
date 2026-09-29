@extends('layouts.app')
@section('content')
<div class="experience-page image-manager-page">
  <div class="container image-manager-container">
    <a href="{{ route('cars.mine') }}" class="experience-back-link">← Back to My Cars</a>
    <div class="image-manager-heading" data-reveal><div><span class="experience-eyebrow">SHOW IT FROM EVERY ANGLE</span><h1>Photos for {{ $car->maker }} {{ $car->model }}</h1><p>{{ $car->year }} · {{ $car->city ?: ($car->state ?: 'Location not set') }}</p></div><a href="{{ route('cars.show',$car) }}" class="experience-outline-button">View listing <span>↗</span></a></div>
    <div class="image-manager-card rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5" data-reveal>
      <div class="image-manager-gallery-heading"><div><h2>Your gallery</h2><p>Photos appear on the listing in the order shown.</p></div><span>{{ $car->images->count() }} / 10 photos</span></div>
      @if($car->images->count())
        <div class="image-manager-grid">@foreach($car->images as $image)<figure><img src="{{ asset('storage/'.$image->path) }}" alt="{{ $car->maker }} {{ $car->model }} photo {{ $loop->iteration }}"><figcaption><span>{{ $loop->first ? 'Cover photo' : 'Photo '.$loop->iteration }}</span><span>{{ str_pad((string)$loop->iteration,2,'0',STR_PAD_LEFT) }}</span></figcaption></figure>@endforeach</div>
      @else
        <div class="image-manager-empty"><span>▧</span><p>No photos uploaded yet. Add at least one to make this listing visible to shoppers.</p></div>
      @endif
      @if($car->images->count() < 10)
        <form method="POST" action="{{ route('cars.images.upload',$car) }}" enctype="multipart/form-data" class="image-manager-upload">@csrf
          <div class="image-manager-upload-copy"><span class="image-upload-round">↥</span><div><strong>Add more photos</strong><small>Choose multiple images · 5 MB maximum each</small></div></div>
          <label class="image-manager-file-label"><span>Choose photos</span><input type="file" name="images[]" multiple accept="image/*" required><em>{{ 10 - $car->images->count() }} remaining</em></label>
          <button type="submit" class="experience-primary-button">Upload photos <span>→</span></button>
        </form>
      @else
        <div class="image-manager-limit"><span>✓</span>You’ve added the maximum of 10 photos.</div>
      @endif
    </div>
  </div>
</div>
@endsection
