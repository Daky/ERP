<?php

namespace ERP\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    protected $fillable = ['account', 'password', 'email','name'];

    protected $guarded = ['id'];

    protected function getSidebarMenu(){
        $res = array();

        $user_id = session('user.id');

    	$result = DB::table('role_user AS a')
            ->select(DB::raw('d.name AS kind_name ,d.route_url , c.*'))
            ->where(['user_id'=>$user_id])
            ->leftJoin('permission_role AS b', 'a.role_id', '=', 'b.role_id')
            ->leftJoin('permissions AS c', 'c.id', '=', 'b.permission_id')
            ->leftJoin('permission_kinds AS d', 'c.permission_kind_id', '=', 'd.id')
            ->orderBy('c.permission_kind_id','ASC')
            ->get();
            
        foreach ($result as $key => $obj) {

            if(!isset($res[$obj->permission_kind_id])){
                $res[$obj->permission_kind_id]['data'] = array();
                $res[$obj->permission_kind_id]['name'] = $obj->kind_name;
                $res[$obj->permission_kind_id]['route_url'] = $obj->route_url;
            } 
            $res[$obj->permission_kind_id]['data'][] = $obj;

        }
        return $res;
    }
}
