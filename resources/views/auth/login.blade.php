@extends('layouts.guest')

@section('title', '登入內部系統')

@section('content')
<div class="guest-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">登入內部系統</p>
        <form role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback{{ $errors->has('account') ? ' has-error' : '' }}">
                <input id="account" type="text" class="form-control" name="account" value="{{ old('account') }}" placeholder="請輸入帳號" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('account'))
                    <span class="help-block">
                        <strong>{{ $errors->first('account') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="請輸入密碼" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember"> 記住我
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">登入</button>
        </form>
        <hr>
        <ul class="nav nav-pills nav-justified">
          <li><a href="{{ url('/password/reset') }}">重設密碼</a></li>
          {{-- <li><a href="{{ url('/register') }}">註冊帳號</a></li> --}}
      </ul>
  </div>
</div>
@endsection