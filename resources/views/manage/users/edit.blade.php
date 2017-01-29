@extends('layouts.app')

@section('content_header')
    @include('title')
    @include('breadcrumb')
@endsection

@section('content')
@if($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form class="form-horizontal" action="{{ url('manage/users/update') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $user->id }}">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <img src="{{ $user->avatar ? url($user->avatar) : Config::get('const.default_avatar') }}" class="img-circle img-responsive center-block" alt="User Image">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <label for="avatar">大頭照</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                    <div class="checkbox">
                                        <label for="remove_avatar">
                                            <input type="checkbox" id="remove_avatar" name="remove_avatar" value="1">
                                            移除大頭照
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <label>職務</label>
                                    @foreach ($roles as $role)
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="roles" value="{{ $role->id }}" {{ $role->checked ? 'checked' : '' }} required>
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
                                <label class="col-sm-2 control-label" for="account">員工編號</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入員工編號" name="account" id="account" value="{{ $user->account }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="name">姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入姓名" name="name" id="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="email">電子信箱位址</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="請輸入電子信箱位址" name="email" id="email" value="{{ $user->email }}" required>
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