@extends('layouts.guest')

@section('title', '註冊新帳號')

@section('content')
<div class="guest-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">註冊新帳號</p>
        <form role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="請輸入姓名" required autofocus>
                <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="請輸入電子信箱位址" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="account" type="text" class="form-control" name="account" value="{{ old('account') }}" placeholder="請輸入員工編號" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control" name="password" placeholder="請輸入密碼" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="請再次輸入密碼" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">註冊</button>
        </form>
        <hr>
        <ul class="nav nav-pills nav-justified">
        <li><a href="{{ url('/login') }}">登入帳號</a></li>
      </ul>
  </div>
</div>
@endsection
