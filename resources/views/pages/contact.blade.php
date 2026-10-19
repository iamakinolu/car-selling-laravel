@extends('layouts.app')
@section('content')
<div class="contact-page">
  <section class="contact-hero"><div class="container mx-auto max-w-7xl px-5 py-16 md:px-8 md:py-24"><span class="experience-eyebrow">CONTACT SHOWBOY MOTORS</span><h1>We’re here to help<br><span>you move forward.</span></h1><p>Have a question about a listing or need help using the site? Get in touch and we’ll help point you in the right direction.</p></div></section>
  <section class="container mx-auto max-w-7xl px-5 py-12 md:px-8 md:py-16">
    <div class="contact-layout">
      <div class="contact-intro"><span class="experience-eyebrow">GET IN TOUCH</span><h2>Let’s make your next step easier.</h2><p>For questions about a specific car, include its make and model or a link to the listing so we can understand your enquiry.</p><div class="contact-note"><span aria-hidden="true">✳</span><p>Looking for a particular vehicle? <a href="{{ route('cars.index') }}">Browse current listings</a> while you’re here.</p></div></div>
      <div class="contact-card"><div class="contact-card-icon" aria-hidden="true">✉</div><span class="experience-eyebrow">EMAIL OUR TEAM</span><h3>Send us a message</h3><p>We welcome your questions and feedback. Write to us and include any details that will help us respond.</p><a class="contact-email" href="mailto:segunadetuwo@gmail.com">segunadetuwo@gmail.com <span aria-hidden="true">↗</span></a><div class="contact-details"><h4>Contact details</h4><a href="tel:08034688359">08034688359</a><p>14a, Abimbola Okulaja,<br>Lekki Phase 1</p></div><div class="contact-card-foot"><span class="contact-status-dot"></span> We look forward to hearing from you</div></div>
    </div>
  </section>
</div>
@endsection
