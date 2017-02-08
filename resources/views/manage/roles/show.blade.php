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
                    <a href="{{ url('manage/roles/edit/' . $role->id) }}" class="btn btn-default">編輯</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('manage/roles/destroy/' . $role->id) }}" class="destroy-role">刪除職務</a></li>
                    </ul>
                </div>
                @if ($role->display_name)
                <h4>{{ $role->display_name }} <small>{{ $role->name }}</small></h4>
                @else
                <h4>{{ $role->name }}</h4>
                @endif
            </div>
            <div class="box-body">
                @if ($role->description)
                    <p>{{ $role->description }}</p>
                @else
                    <p class="text-muted">尚無描述</p>
                @endif
            </div>
            {{-- <div class="box-footer">
            </div> --}}
        </div>
        <div class="box">
            <div class="box-header"><h4>相關帳號列表</h4></div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>帳號</th>
                                <th>姓名</th>
                                <th>電子信箱</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->account }}</td>
                                <td><a href="{{ URL::to('manage/users/show/' . $user->id) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                            @if (count($users) == 0)
                            <tr>
                                <td colspan="4" class="text-center text-muted">尚無帳號</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.destroy-role').click(function(event) {
        @if (count($users) == 0)
        if (!confirm('確認要刪除此職務？')) {
            return false;
        }
        @else
        alert('此職務還有相關帳號，不可刪除！');
        return false;
        @endif
    });
</script>
@endsection