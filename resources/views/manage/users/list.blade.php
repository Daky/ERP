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
                <a href="{{ url('manage/users/create') }}" class="btn btn-primary">新增帳號</a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>帳號</th>
                                <th>權限</th>
                                <th>姓名</th>
                                <th>電子信箱</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->account }}</td>
                                <td>
                                    @if (!is_null($user->role_id) && !is_null($user->role_name))
                                    <a href="{{ url('manage/roles/show/' . $user->role_id) }}">{{ $user->role_name }}</a>
                                    @else
                                    無
                                    @endif
                                </td>
                                <td><a href="{{ url('manage/users/show/' . $user->id) }}">{{ $user->name }}</a></td>
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
            <div class="box-footer">
                {{ $users->links() }}
                {{-- <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                </ul> --}}
            </div>
        </div>
    </div>
</div>
@endsection