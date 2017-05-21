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
                <form id="form">
                    日期:
                    <input type="date" name="date" id="date" value="{{ $data['date'] }}">
                    分區:
                    <select name="machine_region" id="machine_region">
                        <?php foreach (config('derbou.machine_region') as $key => $value) { ?>
                        <option {{ ($data['machine_region']==$key)?'selected':'' }} value="{{ $key }}">{{ $value }}</option>
                        <?php } ?>
                    </select>
                <span class="btn btn-success" id="search">查詢</span>
                <span class="btn btn-primary" id="reload">刷新頁面</span>
                <span style="float:right" class="btn btn-danger" id="edit">修改紀錄</span>
                </form>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tr class="head-color">
                        <th></th>
                        <th colspan="8"><span style="color:blue">{{ $data['machine_region'] }}區</span> 作業人員效率表</th>
                        <th>{{ $data['date'] }}</th>
                    </tr>
                    <tr class="head-color">
                        <th></th>
                    @foreach(config('derbou.time_region') as $k => $v) 
                        <th colspan="3">
                            <span>{{ $data['data'][$k]['name'] }}</span>
                            <span style="color:blue" class="detail-show">{{ isset($data['user'][$data['data'][$k]['user_id']])?$data['user'][$data['data'][$k]['user_id']]['name']: '未設定人員' }}</span>
                            <select class="detail-show user-edit" data-time_region="{{ $k }}" data-column="user_id" style="display: none">
                                <option value="">-</option>
                            @foreach($data['user'] as $kk => $vv) 
                                <option data-test="{{ $data['data'][$k]['user_id'] }}" data-vv="{{ $vv['id'] }}"
                                 {{ (intval($data['data'][$k]['user_id'])==intval($vv['id']))? 'selected': '' }} value="{{ $vv['id'] }}">{{ $vv['name'] }}</option>
                                }
                            @endforeach
                            </select>
                        </th>
                    @endforeach
                    </tr>
                    <tr class="head-color">
                        <th>機號</th>
                        @for ($i = 1; $i <= count(config('derbou.time_region')); $i++)
                        <th>碼數</th>
                        <th>狀態</th>
                        <th>備註</th>
                        @endfor
                    </tr>
                    @foreach(config('derbou.machine_no')[$data['machine_region']] as $k => $v) 
                    <tr>
                        <td>{{ $k }}</td>
                        @foreach(config('derbou.time_region') as $kk => $vv) 
                        <td>
                            <span class="detail-show">{{ $data['data'][$kk]['data'][$k]['yard'] }}</span>
                            <input size="4" class="detail-show detail-edit" data-uid="{{ sha1($data['date'].$kk.$k) }}" data-machine_no="{{ $k }}" data-column="yard" style="display: none"  data-time_region="{{ $kk }}" data-machine_region="{{ $data['machine_region'] }}" value="{{ $data['data'][$kk]['data'][$k]['yard'] }}">
                        </td>
                        <td>
                            <span class="detail-show">{{ $data['data'][$kk]['data'][$k]['kind'] }}</span>
                            <select class="detail-show detail-edit" data-uid="{{ sha1($data['date'].$kk.$k) }}"  data-column="kind" style="display: none"  data-time_region="{{ $kk }}" data-machine_region="{{ $data['machine_region'] }}">
                                <option value="">-</option>
                                @foreach(config('derbou.human_efficiency_kind') as $kkk => $vvv) 
                                <option {{ ($kkk==$data['data'][$kk]['data'][$k]['kind'])? 'selected': '' }} value="{{ $kkk }}">{{ $vvv }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <span class="detail-show">{{ $data['data'][$kk]['data'][$k]['memo'] }}</span>
                            <input size="12" class="detail-show detail-edit" data-uid="{{ sha1($data['date'].$kk.$k) }}" data-column="memo" style="display: none"  data-time_region="{{ $kk }}" data-machine_region="{{ $data['machine_region'] }}" value="{{ $data['data'][$kk]['data'][$k]['memo'] }}">
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </table>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){
        $('#search').on('click',function(){
            $('#form').submit();
        });
        $('#edit').on('click',function(){
            $(".detail-show").toggle();
            $('#machine_region').prop('disabled', function(i, v) { return !v; });
            $('#date').prop('disabled', function(i, v) { return !v; });
        });
        $('#reload').on('click',function(){
            location.reload();
        });
        $('.detail-edit').on('blur',function(){
            var uid = $(this).attr('data-uid');
            var obj = {};
            obj.action = 'detail';
            obj.date = $('#date').val(); 
            obj.machine_region = $('#machine_region').val(); 
            obj.time_region = $(this).attr('data-time_region');
            obj.machine_no = $('input[data-column="yard"][data-uid="'+uid+'"]').attr('data-machine_no');
            obj.yard = $('input[data-column="yard"][data-uid="'+uid+'"]').val();
            obj.kind = $('select[data-column="kind"][data-uid="'+uid+'"]').val();
            obj.memo = $('input[data-column="memo"][data-uid="'+uid+'"]').val();
            obj.user_id = $('select[data-column="user_id"][data-time_region="'+obj.time_region+'"]').val();
            console.log(obj);
            do_post('/derbou/humanefficiency/update',obj,function(data){
                console.log('ajax update detail success');
            });
        });
        $('.user-edit').on('change',function(){
            var obj = {};
            obj.action = 'user';
            obj.date = $('#date').val();
            obj.machine_region = $('#machine_region').val();
            obj.time_region = $(this).attr('data-time_region');
            obj.user_id = $(this).val();
            console.log(obj);
            do_post('/derbou/humanefficiency/update',obj,function(data){
                console.log('ajax update user success');
            });  
        });
    });
</script>
@endsection