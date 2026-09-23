@extends('layouts.app')
@section('content')
<div class="container"><h1>Manage Images — {{ $car->year }} {{ $car->maker }} {{ $car->model }}</h1>
<div class="card p-large">
  <div class="image-grid">@forelse($car->images as $image)<div><img class="car-image-manage" src="{{ asset('storage/'.$image->path) }}" alt=""></div>@empty<p>No images yet.</p>@endforelse</div>
  <hr>
  <form method="POST" action="{{ route('cars.images.upload',$car) }}" enctype="multipart/form-data">@csrf
    <div class="form-group"><label>Add images</label><input type="file" name="images[]" multiple accept="image/*" required></div>
    <button class="btn btn-primary">Upload Images</button>
  </form>
</div></div>
@endsection