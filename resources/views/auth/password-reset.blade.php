@extends('layouts.app')
@section('content')
<div class="container-small page-login"><div class="auth-page-form">
<div class="text-center"><a href="{{ route('home') }}"><img src="{{ asset('img/logoipsum-265.svg') }}" alt=""></a></div>
<h1 class="auth-page-title">Reset Password</h1>
<p class="text-muted">Enter your email and Laravel will generate a password reset request.</p>
<form action="{{ route('password.email') }}" method="POST">@csrf
<div class="form-group"><input name="email" value="{{ old('email') }}" placeholder="Your Email" type="email" required></div>
<button class="btn btn-primary w-full">Send Reset Link</button>
</form>
</div></div>
@endsection