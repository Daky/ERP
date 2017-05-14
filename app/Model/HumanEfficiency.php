<?php

namespace ERP\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class HumanEfficiency extends Model
{
	protected $table = 'derbou_human_efficiency';

    protected $fillable = [
        'data_date','time_region','machine_no','yard', 'kind', 'memo', 'user_id',
    ];

    public function getDataByDate($date , $machine_region = 'A'){
    	$res = array();
    	
    	//init
    	$res['date'] = $date;
    	$res['machine_region'] = $machine_region;
    	$res['data'] = array();
    	foreach (config('derbou.time_region') as $k => $v) {
    		$res['data'][$k]['name'] = $v;
    		$res['data'][$k]['user_id'] = '';
    		$res['data'][$k]['data'] = array();
    		foreach (config('derbou.machine_no')[$machine_region] as $kk => $vv) {
    			$res['data'][$k]['data'][$kk]['yard'] = '';
    			$res['data'][$k]['data'][$kk]['kind'] = '';
    			$res['data'][$k]['data'][$kk]['memo'] = '';

    		}
    	}

    	$result = DB::table('derbou_human_efficiency AS a')
    	->select(DB::raw('a.* , b.name'))
    	->where('a.data_date',$date)
    	->leftJoin('users AS b','a.user_id','b.id')
    	->get();
    	foreach ($result as $k => $v) {
    		$res['data'][$v->time_region]['user_id'] = $v->user_id;
    		$res['data'][$v->time_region]['data'][$v->machine_no]['yard'] = $v->yard;
    		$res['data'][$v->time_region]['data'][$v->machine_no]['kind'] = $v->kind;
    		$res['data'][$v->time_region]['data'][$v->machine_no]['memo'] = $v->memo;
    	}

    	return $res;
    }
}
