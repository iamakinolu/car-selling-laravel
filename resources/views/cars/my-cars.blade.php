@extends('layouts.app')
@section('content')
<div class="container">
  <div class="flex items-center justify-between mb-medium"><h1>My Cars</h1><a class="btn btn-primary" href="{{ route('cars.create') }}">＋ Add New Car</a></div>
  <div class="card p-medium">
    <table class="my-cars-table"><thead><tr><th>Image</th><th>Car</th><th>Published</th><th>Actions</th></tr></thead><tbody>
    @forelse($cars as $car)
      <tr>
        <td><img class="my-cars-img-thumbnail" src="{{ $car->primary_image_url }}" alt=""></td>
        <td><strong>{{ $car->year }} - {{ $car->maker }} {{ $car->model }}</strong><br><span class="text-muted">${{ number_format($car->price,0) }}</span></td>
        <td>{{ $car->published ? 'Yes' : 'No' }}</td>
        <td class="flex gap-1">
          <a class="btn btn-edit" href="{{ route('cars.edit',$car) }}">Edit</a>
          <a class="btn btn-edit" href="{{ route('cars.images',$car) }}">Images</a>
          <form method="POST" action="{{ route('cars.destroy',$car) }}" onsubmit="return confirm('Delete this car?')">@csrf @method('DELETE')<button class="btn btn-delete">Delete</button></form>
        </td>
      </tr>
    @empty
      <tr><td colspan="4" class="text-center p-large">You haven't listed any cars yet.</td></tr>
    @endforelse
    </tbody></table>
  </div>
  <div class="my-large">{{ $cars->links() }}</div>
</div>
@endsection