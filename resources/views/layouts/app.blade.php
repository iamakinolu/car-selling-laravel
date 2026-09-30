<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Car Findal Service' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-stone-50 font-sans text-slate-800 antialiased">
<header class="navbar sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 shadow-sm backdrop-blur-xl">
  <div class="container navbar-content mx-auto flex w-full max-w-7xl items-center justify-between px-5 py-3 md:px-8">
    <a href="{{ route('home') }}" class="logo-wrapper flex items-center gap-2.5 text-lg font-extrabold tracking-tight text-ink-950 transition hover:text-brand-600" aria-label="Car Findal home"><img class="h-9 w-9" src="{{ asset('img/car-findal-mark.svg') }}" alt=""><span>Car Findal</span></a>
    <button class="btn btn-default btn-navbar-toggle rounded-xl border border-slate-200 bg-white p-2 shadow-sm transition hover:border-brand-200 hover:text-brand-600" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="siteNavigation">
      <svg class="nav-icon-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
      <svg class="nav-icon-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18"/></svg>
    </button>
    <div class="navbar-panel min-[761px]:items-center min-[761px]:gap-8" id="siteNavigation">
      <nav class="site-nav min-[761px]:items-center min-[761px]:gap-2" aria-label="Main navigation">
        <a class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-brand-50 hover:text-brand-700" href="{{ route('cars.index') }}" @class(['is-current' => request()->routeIs('cars.index', 'cars.show')])>Browse cars</a>
        @guest<a class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-brand-50 hover:text-brand-700" href="{{ route('home') }}#how-it-works">How it works</a>@endguest
        @auth<a class="rounded-full px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-brand-50 hover:text-brand-700" href="{{ route('cars.mine') }}" @class(['is-current' => request()->routeIs('cars.mine')])>My listings</a>@endauth
      </nav>
      <div class="navbar-auth min-[761px]:items-center min-[761px]:gap-3">
        @auth
          <a href="{{ route('cars.create') }}" class="nav-sell-link"><span aria-hidden="true">＋</span> Sell a car</a>
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
        @else
          <a href="{{ route('login') }}" class="nav-login">Log in</a>
          <a href="{{ route('signup') }}" class="nav-signup">Create account <span aria-hidden="true">→</span></a>
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
  <div class="container site-footer-main mx-auto flex w-full max-w-7xl flex-col gap-10 px-5 py-12 md:flex-row md:justify-between md:px-8"><div class="site-footer-brand max-w-sm"><a class="mb-4 inline-flex items-center gap-3 text-lg font-bold tracking-tight text-white" href="{{ route('home') }}"><img class="h-10 w-10" src="{{ asset('img/car-findal-mark.svg') }}" alt=""><span>Car Findal</span></a><p class="max-w-xs text-sm leading-6 text-slate-400">A thoughtful place to find your next car or a new owner for the one you have.</p></div><div class="site-footer-links flex flex-wrap gap-10"><div><strong class="mb-2 block text-xs uppercase tracking-widest text-slate-300">Explore</strong><a class="transition hover:text-brand-300" href="{{ route('cars.index') }}">Browse cars</a><a class="transition hover:text-brand-300" href="{{ route('home') }}#how-it-works">How it works</a></div><div><strong class="mb-2 block text-xs uppercase tracking-widest text-slate-300">For sellers</strong><a class="transition hover:text-brand-300" href="{{ auth()->check() ? route('cars.create') : route('signup') }}">List your car</a>@auth<a class="transition hover:text-brand-300" href="{{ route('cars.mine') }}">My listings</a>@endauth</div><div><strong class="mb-2 block text-xs uppercase tracking-widest text-slate-300">Your account</strong>@guest<a class="transition hover:text-brand-300" href="{{ route('login') }}">Sign in</a><a class="transition hover:text-brand-300" href="{{ route('signup') }}">Create account</a>@else<a class="transition hover:text-brand-300" href="{{ route('watchlist') }}">My favourites</a>@endguest</div></div></div>
  <div class="container site-footer-bottom mx-auto flex w-full max-w-7xl items-center justify-between border-t border-white/10 px-5 py-4 text-xs text-slate-500 md:px-8"><span>© {{ date('Y') }} Car Findal</span><span>Made for the road ahead <i class="text-brand-400">✦</i></span></div>
</footer>
<script src="/js/app.js" defer></script>
@stack('scripts')
</body>
</html>
