@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="guest-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </form>
        <hr>
        <ul class="nav nav-pills nav-justified">
        <li><a href="{{ url('/login') }}">Sign in</a></li>
      </ul>
  </div>
</div>
@endsection
