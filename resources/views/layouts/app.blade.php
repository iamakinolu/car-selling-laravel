<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Showboy Motors' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-stone-50 font-sans text-slate-800 antialiased">
<header class="navbar sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 shadow-sm backdrop-blur-xl">
  <div class="container navbar-content mx-auto flex w-full max-w-7xl items-center justify-between px-5 py-3 md:px-8">
    <a href="{{ route('home') }}" class="logo-wrapper flex items-center text-lg font-extrabold tracking-tight text-ink-950 transition hover:text-brand-600" aria-label="SHOWBOY MOTORS home"><span>SHOWBOY MOTORS</span></a>
    <button class="btn btn-default btn-navbar-toggle rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:border-brand-200 hover:text-brand-600" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="siteNavigation">
      <svg class="nav-icon-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
      <svg class="nav-icon-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18"/></svg>
    </button>
    <div class="navbar-panel min-[761px]:items-center min-[761px]:gap-8" id="siteNavigation">
      <nav class="site-nav min-[761px]:items-center min-[761px]:gap-2" aria-label="Main navigation">
        <a class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-brand-50 hover:text-brand-700" href="{{ route('cars.index') }}" @class(['is-current' => request()->routeIs('cars.index', 'cars.show')])>Browse cars</a>
        <a class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-brand-50 hover:text-brand-700" href="{{ route('about') }}">About us</a><a class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-brand-50 hover:text-brand-700" href="{{ route('contact') }}">Contact us</a>
        @auth<a class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-brand-50 hover:text-brand-700" href="{{ route('cars.mine') }}" @class(['is-current' => request()->routeIs('cars.mine')])>My listings</a>@endauth
      </nav>
      <div class="navbar-auth min-[761px]:items-center min-[761px]:gap-3">
        @auth
          <a href="{{ route('cars.create') }}" class="nav-sell-link"><span aria-hidden="true">+</span> Sell a car</a>
          <div class="navbar-menu">
            <button type="button" class="navbar-menu-handler" aria-expanded="false" aria-haspopup="true">
              <span class="nav-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span><span class="nav-account-label">Account</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 7.5 5 5 5-5"/></svg>
            </button>
            <ul class="submenu">
              <li><a href="{{ route('cars.mine') }}">My Cars</a></li>
              <li><a href="{{ route('watchlist') }}">My Favourites</a></li>
              <li><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Log out</button></form></li>
            </ul>
          </div>
        @endauth
      </div>
    </div>
  </div>
</header>
@if(session('success'))<div class="container"><div class="alert alert-success">{{ session('success') }}</div></div>@endif
@if(session('status'))<div class="container"><div class="alert alert-success">{{ session('status') }}</div></div>@endif
@if($errors->any())<div class="container"><div class="alert alert-error"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>@endif
<main class="min-h-[65vh] p-0">@yield('content')</main>
<footer class="site-footer border-t border-white/10 bg-ink-950 text-white">
  <div class="container site-footer-main mx-auto grid w-full max-w-7xl gap-12 px-5 py-12 md:grid-cols-[1.5fr_1fr_1fr] md:px-8 md:py-16">
    <div class="site-footer-brand"><a class="inline-flex items-center text-lg font-bold tracking-tight text-white" href="{{ route('home') }}"><span>SHOWBOY MOTORS</span></a><p>Find the right car for the road ahead. Explore listings and connect with sellers, all in one place.</p><a class="site-footer-email" href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }} <span aria-hidden="true">&rarr;</span></a></div>
    <div class="site-footer-links"><div><strong>Explore</strong><a href="{{ route('cars.index') }}">Browse cars</a><a href="{{ route('about') }}">About us</a></div><div><strong>Your account</strong>@auth<a href="{{ route('cars.mine') }}">My listings</a>@else<a href="{{ route('login') }}">Sign in</a><a href="{{ route('signup') }}">Create an account</a>@endauth</div></div>
    <div class="site-footer-contact"><strong>Need a hand?</strong><p>Questions about a listing or the site? We are happy to help.</p><a href="{{ route('contact') }}">Contact our team <span aria-hidden="true">&rarr;</span></a></div>
  </div>
  <div class="container site-footer-bottom mx-auto flex w-full max-w-7xl flex-col gap-2 border-t border-white/10 px-5 py-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between md:px-8"><span>&copy; {{ date('Y') }} SHOWBOY MOTORS. All rights reserved.</span></div>
</footer>
<script src="/js/app.js" defer></script>
@stack('scripts')
</body>
</html>
