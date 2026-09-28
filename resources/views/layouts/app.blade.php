<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Car Findal Service' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    @stack('styles')
</head>
<body>
<header class="navbar">
  <div class="container navbar-content">
    <a href="{{ route('home') }}" class="logo-wrapper" aria-label="Car Findal home"><img src="{{ asset('img/logoipsum-265.svg') }}" alt=""><span>Car Findal</span></a>
    <button class="btn btn-default btn-navbar-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="siteNavigation">
      <svg class="nav-icon-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
      <svg class="nav-icon-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18"/></svg>
    </button>
    <div class="navbar-panel" id="siteNavigation">
      <nav class="site-nav" aria-label="Main navigation">
        <a href="{{ route('cars.index') }}" @class(['is-current' => request()->routeIs('cars.index', 'cars.show')])>Browse cars</a>
        @guest<a href="{{ route('home') }}#how-it-works">How it works</a>@endguest
        @auth<a href="{{ route('cars.mine') }}" @class(['is-current' => request()->routeIs('cars.mine')])>My listings</a>@endauth
      </nav>
      <div class="navbar-auth">
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
<main>@yield('content')</main>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
