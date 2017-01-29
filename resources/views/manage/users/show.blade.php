@extends('layouts.app')

@section('content_header')
    @include('title')
    @include('breadcrumb')
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="btn-group pull-right">
                    <a href="{{ url('manage/users/edit/' . $user->id) }}" class="btn btn-default">編輯</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('manage/users/disable/' . $user->id) }}" class="disable-account">停用帳號</a></li>
                    </ul>
                </div>
                <div class="media">
                    <div class="media-left">
                        <img src="{{ $user->avatar ? url($user->avatar) : Config::get('const.default_avatar') }}" class="img-md img-circle" alt="User Image">
                    </div>
                    <div class="media-body">
                        <h4>{{ $user->name }}</h4>
                        {{ $user->role_name or '&lt;無權限&gt;' }}
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#user_tab_1" aria-controls="user_tab_1" role="tab" data-toggle="tab">預留選單一</a></li>
                        <li role="presentation"><a href="#user_tab_2" aria-controls="user_tab_2" role="tab" data-toggle="tab">預留選單二</a></li>
                        <li role="presentation"><a href="#user_tab_3" aria-controls="user_tab_3" role="tab" data-toggle="tab">預留選單三</a></li>
                        <li role="presentation"><a href="#user_tab_4" aria-controls="user_tab_4" role="tab" data-toggle="tab">預留選單四</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="user_tab_1">
                            &nbsp;
                        </div>
                        <div role="tabpanel" class="tab-pane" id="user_tab_2">
                            &nbsp;
                        </div>
                        <div role="tabpanel" class="tab-pane" id="user_tab_3">
                            &nbsp;
                        </div>
                        <div role="tabpanel" class="tab-pane" id="user_tab_4">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="box-footer">
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.disable-account').click(function(event) {
        if (!confirm('確認要停用此使用者？')) {
            return false;
        }
    });
</script>
@endsection