@extends('layouts.app')

@section('content_header')
    @include('title')
    @include('breadcrumb')
@endsection

@section('content')
@if($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form class="form-horizontal" action="{{ url('manage/users/store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <img src="{{ Config::get('const.default_avatar') }}" class="img-responsive img-circle" alt="User Image" style="margin: 0 auto;">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <label for="avatar">大頭照</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <label>職務</label>
                                    @foreach ($roles as $role)
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="roles" value="{{ $role->id }}" required>
                                            {{ $role->role_name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="account">帳號</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入帳號" name="account" id="account" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="name">姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入姓名" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="email">電子信箱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入電子信箱" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">密碼</label>
                                <div class="col-sm-10">
                                    <p class="form-control">123456</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <hr>
                                    <button type="submit" class="btn btn-primary">儲存</button>
                                    或
                                    <a href="javascript:history.go(-1);">返回</a>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection