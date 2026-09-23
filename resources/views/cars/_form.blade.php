@php($editing = isset($car))
<form method="POST" action="{{ $editing ? route('cars.update',$car) : route('cars.store') }}" enctype="multipart/form-data">
@csrf
@if($editing) @method('PUT') @endif
<div class="grid grid-cols-2 gap-1">
  <div class="form-group"><label>Maker</label><input name="maker" value="{{ old('maker',$car->maker ?? '') }}" required placeholder="Lexus"></div>
  <div class="form-group"><label>Model</label><input name="model" value="{{ old('model',$car->model ?? '') }}" required placeholder="RX200t"></div>
  <div class="form-group"><label>Year</label><input type="number" name="year" value="{{ old('year',$car->year ?? date('Y')) }}" required></div>
  <div class="form-group"><label>Price (USD)</label><input type="number" step="0.01" name="price" value="{{ old('price',$car->price ?? '') }}" required></div>
  <div class="form-group"><label>Mileage</label><input type="number" name="mileage" value="{{ old('mileage',$car->mileage ?? 0) }}" required></div>
  <div class="form-group"><label>State</label><input name="state" value="{{ old('state',$car->state ?? '') }}" placeholder="Lagos"></div>
  <div class="form-group"><label>City</label><input name="city" value="{{ old('city',$car->city ?? '') }}" placeholder="Ikeja"></div>
  <div class="form-group"><label>Car Type</label><select name="car_type">@foreach(['sedan','hatchback','suv'] as $v)<option value="{{ $v }}" @selected(old('car_type',$car->car_type ?? '')===$v)>{{ ucfirst($v) }}</option>@endforeach</select></div>
  <div class="form-group"><label>Fuel Type</label><select name="fuel_type">@foreach(['gasoline','diesel','electric','hybrid'] as $v)<option value="{{ $v }}" @selected(old('fuel_type',$car->fuel_type ?? '')===$v)>{{ ucfirst($v) }}</option>@endforeach</select></div>
</div>
<div class="form-group"><label>Description</label><textarea name="description" rows="5">{{ old('description',$car->description ?? '') }}</textarea></div>
<div class="form-group">
<label>Features</label>
<div class="grid grid-cols-3 gap-1">
@foreach(['air_conditioning','power_windows','power_door_locks','abs','cruise_control','bluetooth_connectivity','remote_start','gps_navigation','heated_seats','climate_control','rear_parking_sensors','leather_seats'] as $feature)
<label class="checkbox"><input type="checkbox" name="features[]" value="{{ $feature }}" @checked(in_array($feature,old('features',$car->features ?? [])))> {{ ucwords(str_replace('_',' ',$feature)) }}</label>
@endforeach
</div></div>
@if(!$editing)<div class="form-group"><label>Car Images</label><input id="carFormImageUpload" type="file" name="images[]" accept="image/*" multiple><div id="imagePreviews" class="image-previews"></div></div>@endif
<div class="form-group"><label class="checkbox"><input type="checkbox" name="published" value="1" @checked(old('published',$car->published ?? false))> Publish this car</label></div>
<button class="btn btn-primary" type="submit">{{ $editing ? 'Update Car' : 'Add Car' }}</button>
<a class="btn btn-default" href="{{ $editing ? route('cars.mine') : route('home') }}">Cancel</a>
</form>