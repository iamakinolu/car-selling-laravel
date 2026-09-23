@extends('layouts.app')
@section('content')
<div class="container-small page-login"><div class="flex" style="gap:5rem"><div class="auth-page-form">
<div class="text-center"><a href="{{ route('home') }}"><img src="{{ asset('img/logoipsum-265.svg') }}" alt=""></a></div>
<h1 class="auth-page-title">Login</h1>
<form action="{{ route('login.store') }}" method="POST">@csrf
<div class="form-group"><input name="email" value="{{ old('email') }}" placeholder="Your Email" type="email" required></div>
<div class="form-group"><input name="password" placeholder="Your Password" type="password" required></div>
<div class="text-right mb-medium"><a class="auth-page-password-reset" href="{{ route('password.request') }}">Reset Password</a></div>
<button class="btn btn-primary btn-login w-full">Login</button>
</form>
<div class="login-text-dont-have-account">Don't have an account? - <a href="{{ route('signup') }}">Click here to create one</a></div>
</div><div class="auth-page-image"><img class="img-responsive" src="{{ asset('img/car-png-39071.png') }}" alt=""></div></div></div>
@endsection