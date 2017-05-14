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
                <a href="{{ url('manage/permissions/create') }}" class="btn btn-primary">新增權限</a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>權限</th>
                                <th>路徑別名</th>
                                <th>角色人數</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td><a href="{{ url('manage/permissions/show/' . $permission->id) }}">{{ $permission->name }}</td>
                                <td>{{ $permission->route_name }}</td>
                                <td>{{ $permission->roles }}</td>
                            </tr>
                            @endforeach
                            @if (count($permissions) == 0)
                            <tr>
                                <td colspan="2" class="text-center text-muted">尚無職務</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                {{ $permissions->links() }}
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