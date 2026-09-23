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
    @stack('styles')
</head>
<body>
<header class="navbar">
  <div class="container navbar-content">
    <a href="{{ route('home') }}" class="logo-wrapper"><img src="{{ asset('img/logoipsum-265.svg') }}" alt="Logo"></a>
    <button class="btn btn-default btn-navbar-toggle" type="button">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:24px"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
    </button>
    <div class="navbar-auth">
      @auth
        <a href="{{ route('cars.create') }}" class="btn btn-add-new-car">＋ Add new Car</a>
        <div class="navbar-menu" tabindex="-1">
          <a href="javascript:void(0)" class="navbar-menu-handler">My Account
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:20px"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
          </a>
          <ul class="submenu">
            <li><a href="{{ route('cars.mine') }}">My Cars</a></li>
            <li><a href="{{ route('watchlist') }}">My Favourite Cars</a></li>
            <li><form action="{{ route('logout') }}" method="POST">@csrf<button>Logout</button></form></li>
          </ul>
        </div>
      @else
        <a href="{{ route('signup') }}" class="btn btn-primary btn-signup">Signup</a>
        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
      @endauth
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