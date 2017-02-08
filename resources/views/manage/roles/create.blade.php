@extends('layouts.app')

@section('content_header')
    @include('title')
    @include('breadcrumb')
@endsection

@section('content')
@if($errors->any())
<div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form class="form-horizontal" action="{{ url('manage/roles/store') }}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="role_name">完整名稱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="請輸入完整名稱" name="role_name" id="role_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="display_name">顯示名稱</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="請輸入顯示名稱（可省略）" name="display_name" id="display_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">描述</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="請輸入描述（可省略）" name="description" id="description">
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
</form>
@endsection