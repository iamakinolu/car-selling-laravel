@php($editing = isset($car))
<form method="POST" action="{{ $editing ? route('cars.update',$car) : route('cars.store') }}" enctype="multipart/form-data" class="listing-form">
  @csrf
  @if($editing) @method('PUT') @endif

  <section class="listing-form-section">
    <div class="listing-form-section-heading"><span>01</span><div><h2>About the car</h2><p>Start with the basics buyers look for.</p></div></div>
    <div class="listing-input-grid">
      <div class="form-group"><label for="maker">Make</label><input id="maker" name="maker" value="{{ old('maker',$car->maker ?? '') }}" required placeholder="e.g. Lexus"></div>
      <div class="form-group"><label for="model">Model</label><input id="model" name="model" value="{{ old('model',$car->model ?? '') }}" required placeholder="e.g. RX 200t"></div>
      <div class="form-group"><label for="year">Year</label><input id="year" type="number" name="year" value="{{ old('year',$car->year ?? date('Y')) }}" required min="1900" max="{{ date('Y') + 1 }}"></div>
      <div class="form-group"><label for="car_type">Body style</label><select id="car_type" name="car_type" required>@foreach(['sedan','hatchback','suv'] as $v)<option value="{{ $v }}" @selected(old('car_type',$car->car_type ?? '')===$v)>{{ ucfirst($v) }}</option>@endforeach</select></div>
      <div class="form-group"><label for="fuel_type">Fuel type</label><select id="fuel_type" name="fuel_type" required>@foreach(['gasoline','diesel','electric','hybrid'] as $v)<option value="{{ $v }}" @selected(old('fuel_type',$car->fuel_type ?? '')===$v)>{{ ucfirst($v) }}</option>@endforeach</select></div>
      <div class="form-group"><label for="mileage">Mileage <span class="listing-field-hint">miles</span></label><input id="mileage" type="number" name="mileage" value="{{ old('mileage',$car->mileage ?? 0) }}" required min="0" placeholder="e.g. 42000"></div>
      <div class="form-group"><label for="price">Asking price <span class="listing-field-hint">NGN</span></label><div class="listing-price-input"><span>₦</span><input id="price" type="number" step="0.01" name="price" value="{{ old('price',$car->price ?? '') }}" required min="0" placeholder="0.00"></div></div>
    </div>
  </section>

  <section class="listing-form-section">
    <div class="listing-form-section-heading"><span>02</span><div><h2>Location & story</h2><p>Help buyers picture the car and where it is.</p></div></div>
    <div class="listing-input-grid listing-location-grid">
      <div class="form-group"><label for="state">State</label><input id="state" name="state" value="{{ old('state',$car->state ?? '') }}" placeholder="e.g. Lagos"></div>
      <div class="form-group"><label for="city">City</label><input id="city" name="city" value="{{ old('city',$car->city ?? '') }}" placeholder="e.g. Ikeja"></div>
    </div>
    <div class="form-group listing-description"><label for="description">Description <span class="listing-field-hint">Optional</span></label><textarea id="description" name="description" rows="5" placeholder="Share service history, condition, or anything a buyer should know.">{{ old('description',$car->description ?? '') }}</textarea><small>Clear, honest details help buyers know what to expect.</small></div>
  </section>

  <section class="listing-form-section">
    <div class="listing-form-section-heading"><span>03</span><div><h2>Features</h2><p>Select the equipment included with this car.</p></div></div>
    <div class="listing-feature-grid">
      @foreach(['air_conditioning','power_windows','power_door_locks','abs','cruise_control','bluetooth_connectivity','remote_start','gps_navigation','heated_seats','climate_control','rear_parking_sensors','leather_seats'] as $feature)
        <label class="listing-feature"><input type="checkbox" name="features[]" value="{{ $feature }}" @checked(in_array($feature,old('features',$car->features ?? [])))><span class="listing-feature-check">✓</span>{{ ucwords(str_replace('_',' ',$feature)) }}</label>
      @endforeach
    </div>
  </section>

  <section class="listing-form-section listing-photo-section">
    <div class="listing-form-section-heading"><span>04</span><div><h2>Photos</h2><p>Show the details buyers want to see.</p></div></div>
    <div class="form-group car-photo-upload" data-existing-count="{{ $editing ? $car->images->count() : 0 }}" data-max-total="10">
      @if($editing && $car->images->isNotEmpty())
        <div class="listing-current-photos"><strong>Current photos <span>{{ $car->images->count() > 1 ? 'Tap the × to remove a photo.' : 'At least one photo must stay on this listing.' }}</span></strong><div class="image-previews existing-car-photos" aria-label="Current car photos">@foreach($car->images as $image)<div class="listing-photo-thumb"><img src="{{ asset('storage/'.$image->path) }}" alt="Current car photo {{ $loop->iteration }}">@if($loop->count > 1)<button type="button" class="listing-photo-remove" data-delete-url="{{ route('cars.images.destroy',[$car,$image]) }}" aria-label="Remove photo {{ $loop->iteration }}">×</button>@else<span class="listing-photo-protected" title="Every car listing needs at least one photo" aria-label="Required photo">✓</span>@endif</div>@endforeach</div></div>
      @endif
      <label for="carFormImageUpload" class="listing-dropzone"><span class="listing-upload-icon">↥</span><strong>Add car photos</strong><span>At least one photo is required. Select multiple images if you like.</span><em>JPG, PNG or WebP · up to 5 MB each · 10 photos total</em><input id="carFormImageUpload" type="file" name="images[]" accept="image/*" multiple @if(!$editing || $car->images->isEmpty()) required @endif></label>
      <small id="carPhotoCount" class="listing-photo-count" aria-live="polite"></small>
      <small id="listingPhotoFeedback" class="listing-photo-feedback" role="status" aria-live="polite"></small>
      <div id="imagePreviews" class="image-previews" aria-label="Selected photo previews"></div>
    </div>
  </section>

  <div class="listing-form-footer">
    <label class="listing-publish-toggle"><input type="checkbox" name="published" value="1" @checked(old('published',$car->published ?? false))><span class="listing-toggle-track"></span><span><strong>Publish this listing</strong><small>Your car will be visible to shoppers.</small></span></label>
    <div class="listing-form-actions"><a href="{{ $editing ? route('cars.mine') : route('home') }}" class="listing-cancel">Cancel</a><button class="listing-save-button" type="submit">{{ $editing ? 'Save changes' : 'Create listing' }} <span aria-hidden="true">→</span></button></div>
  </div>
</form>
