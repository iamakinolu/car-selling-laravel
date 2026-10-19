@extends('layouts.app')
@section('content')
<div class="listing-page">
  <div class="container listing-page-container">
    <div class="listing-page-heading">
      <div><a href="{{ isset($adminMode) ? route('home') : route('cars.mine') }}" class="listing-back-link">Back</a><span class="listing-page-eyebrow">{{ isset($adminMode) ? 'SHOWBOY MOTORS ADMIN' : 'SELL WITH CONFIDENCE' }}</span><h1>{{ isset($adminMode) ? 'Add a vehicle' : 'Give your car a great introduction.' }}</h1><p>{{ isset($adminMode) ? 'Enter vehicle details and photos to publish it on the site.' : 'Add the details buyers need, then share your listing when it’s ready.' }}</p></div>
      <div class="listing-heading-stamp" aria-hidden="true"><span>YOUR</span><strong>NEXT<br>CHAPTER</strong><i>↗</i></div>
    </div>
    <div class="listing-page-layout">
      <div class="listing-form-card rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5">@include('cars._form')</div>
      <aside class="listing-guidance">
        <div class="listing-guidance-card listing-guidance-dark"><span class="listing-guidance-kicker">SHOWBOY MOTORS</span><h2>{{ isset($adminMode) ? 'Add a vehicle to inventory.' : 'Help your car stand out.' }}</h2><p>Accurate details and clear photos help shoppers understand each vehicle.</p></div>
        <div class="listing-guidance-card"><h3>Before you publish</h3><ul><li><span>01</span>Check the year and mileage</li><li><span>02</span>Set a clear asking price</li><li><span>03</span>Add photos from different angles</li><li><span>04</span>Describe the condition honestly</li></ul></div>
      </aside>
    </div>
  </div>
</div>
@endsection
