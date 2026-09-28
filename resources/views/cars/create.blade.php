@extends('layouts.app')
@push('styles')<link rel="stylesheet" href="{{ asset('css/listing-form.css') }}">@endpush
@section('content')
<div class="listing-page">
  <div class="container listing-page-container">
    <div class="listing-page-heading">
      <div><a href="{{ route('cars.mine') }}" class="listing-back-link">← My listings</a><span class="listing-page-eyebrow">SELL WITH CONFIDENCE</span><h1>Give your car a great introduction.</h1><p>Add the details buyers need, then share your listing when it’s ready.</p></div>
      <div class="listing-heading-stamp" aria-hidden="true"><span>YOUR</span><strong>NEXT<br>CHAPTER</strong><i>↗</i></div>
    </div>
    <div class="listing-page-layout">
      <div class="listing-form-card">@include('cars._form')</div>
      <aside class="listing-guidance">
        <div class="listing-guidance-card listing-guidance-dark"><span class="listing-guidance-symbol">✦</span><span class="listing-guidance-kicker">A LITTLE PREP GOES A LONG WAY</span><h2>Help your car stand out.</h2><p>Accurate details and clear photos make it easier for shoppers to understand your listing.</p></div>
        <div class="listing-guidance-card"><h3>Before you publish</h3><ul><li><span>01</span>Check the year and mileage</li><li><span>02</span>Set a clear asking price</li><li><span>03</span>Add photos from different angles</li><li><span>04</span>Describe the condition honestly</li></ul></div>
        <div class="listing-guidance-note"><span>↗</span><p>You can update your listing and add photos later from <strong>My Cars</strong>.</p></div>
      </aside>
    </div>
  </div>
</div>
@endsection
