@extends('layouts.app')
@push('styles')<link rel="stylesheet" href="{{ asset('css/listing-form.css') }}">@endpush
@section('content')
<div class="listing-page">
  <div class="container listing-page-container">
    <div class="listing-page-heading">
      <div><a href="{{ route('cars.mine') }}" class="listing-back-link">← My listings</a><span class="listing-page-eyebrow">KEEP YOUR LISTING FRESH</span><h1>Make a few updates.</h1><p>Keep the details current so shoppers know what your car has to offer.</p></div>
      <a href="{{ route('cars.show',$car) }}" class="listing-view-link">View listing <span aria-hidden="true">↗</span></a>
    </div>
    <div class="listing-page-layout">
      <div class="listing-form-card">@include('cars._form')</div>
      <aside class="listing-guidance">
        <div class="listing-guidance-card listing-guidance-dark"><span class="listing-guidance-symbol">✦</span><span class="listing-guidance-kicker">YOUR LISTING, YOUR WAY</span><h2>Small updates make a difference.</h2><p>Refresh the mileage, price, and photos as things change. New photos are added to the ones already on your listing.</p></div>
        <div class="listing-guidance-card"><h3>Keep it up to date</h3><ul><li><span>01</span>Review the asking price</li><li><span>02</span>Update mileage when needed</li><li><span>03</span>Add clear, recent photos</li><li><span>04</span>Check your contact details</li></ul></div>
      </aside>
    </div>
  </div>
</div>
@endsection
