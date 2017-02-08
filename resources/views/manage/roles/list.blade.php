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
                <a href="{{ url('manage/roles/create') }}" class="btn btn-primary">新增職務</a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>職務</th>
                                <th>職務人數</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td><a href="{{ url('manage/roles/show/' . $role->id) }}">{{ $role->name }}</td>
                                <td>{{ $role->members }}</td>
                            </tr>
                            @endforeach
                            @if (count($roles) == 0)
                            <tr>
                                <td colspan="2" class="text-center text-muted">尚無職務</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                {{ $roles->links() }}
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