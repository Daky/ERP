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
                <button type="button" class="btn btn-primary">新增</button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>員工編號</th>
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
                                    @if (!is_null($user->role_name))
                                    <a href="#">{{ $user->role_name }}</a>
                                    @else
                                    無
                                    @endif
                                </td>
                                <td><a href="{{ URL::to('manage/users/show/' . $user->id) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
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