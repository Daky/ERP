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
                日期:
                <input type="date" name="date" id="date">
                分區:
                <select name="time_region" id="time_region">
                    <?php foreach (config('derbou.machine_region') as $key => $value) { ?>
                    <option value="{{ $key }}">{{ $value }}</option>
                    <?php } ?>
                </select>
                <span class="btn btn-success" id="search">查詢</span>
                <a href="{{ url('derbou/humanefficiency/create') }}" class="btn btn-primary">新增紀錄</a>
                <a href="{{ url('derbou/humanefficiency/edit') }}" class="btn btn-primary">修改紀錄</a>
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
                            @foreach ($datas as $data)
                            <tr>
                                <td><a href="{{ url('derbou/humanefficiency/show/' . $role->id) }}">{{ $role->name }}</td>
                                <td>{{ $role->members }}</td>
                            </tr>
                            @endforeach
                            @if (count($datas) == 0)
                            <tr>
                                <td colspan="2" class="text-center text-muted">尚無資料</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                {{-- {{ $datas->links() }}
                <ul class="pagination pagination-sm no-margin pull-right">
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
<script type="text/javascript">
    $(function(){
        $('#search').on('click',function(){
            location.reload();
        });
    });
</script>
@endsection