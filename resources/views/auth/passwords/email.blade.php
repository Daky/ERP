@extends('layouts.guest')

@section('title', 'Reset password')

@section('content')
<div class="guest-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Send a email to reset your password</p>
        <form role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
        </form>
        <hr>
        <ul class="nav nav-pills nav-justified">
          <li><a href="{{ url('/login') }}">Sign in</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
      </ul>
  </div>
</div>
@endsection
