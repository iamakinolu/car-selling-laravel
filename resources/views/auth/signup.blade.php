@extends('layouts.app')
@section('content')
<div class="container-small page-login"><div class="flex" style="gap:5rem"><div class="auth-page-form">
<div class="text-center"><a href="{{ route('home') }}"><img src="{{ asset('img/logoipsum-265.svg') }}" alt=""></a></div>
<h1 class="auth-page-title">Signup</h1>
<form action="{{ route('signup.store') }}" method="POST">@csrf
<div class="form-group"><input name="email" value="{{ old('email') }}" placeholder="Your Email" type="email" required></div>
<div class="form-group"><input name="password" placeholder="Your Password" type="password" required></div>
<div class="form-group"><input name="password_confirmation" placeholder="Repeat Password" type="password" required></div><hr>
<div class="form-group"><input name="first_name" value="{{ old('first_name') }}" placeholder="First Name" type="text" required></div>
<div class="form-group"><input name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" type="text" required></div>
<div class="form-group"><input name="phone" value="{{ old('phone') }}" placeholder="Phone" type="text"></div>
<button class="btn btn-primary btn-login w-full">Register</button>
</form>
<div class="login-text-dont-have-account">Already have an account? - <a href="{{ route('login') }}">Click here to login</a></div>
</div><div class="auth-page-image"><img class="img-responsive" src="{{ asset('img/car-png-39071.png') }}" alt=""></div></div></div>
@endsection