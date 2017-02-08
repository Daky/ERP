@extends('layouts.guest')

@section('title', '寄送重設密碼連結')

@section('content')
<div class="guest-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">寄送重設密碼連結</p>
        <form role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="請輸入電子信箱" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">寄送</button>
        </form>
        <hr>
        <ul class="nav nav-pills nav-justified">
          <li><a href="{{ url('/login') }}">登入帳號</a></li>
          {{-- <li><a href="{{ url('/register') }}">註冊帳號</a></li> --}}
      </ul>
  </div>
</div>
@endsection
