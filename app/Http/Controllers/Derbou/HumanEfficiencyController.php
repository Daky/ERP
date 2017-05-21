<?php

namespace ERP\Http\Controllers\Derbou;

use ERP\Model\BreadCrumb;
use ERP\Model\Manage\User;
use ERP\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use ERP\Model\Derbou\HumanEfficiency;

class HumanEfficiencyController extends Controller
{
	protected $date = '';
	protected $machine_region = 'A';

	public function __construct()
    {
        $this->date = dateadd(config('const.today'),-1);
    }
   	protected function index(Request $request){
   		$date = ($request->input('date')==null) ? $this->date : $request->input('date');
   		$machine_region = ($request->input('machine_region')==null) ? $this->machine_region : $request->input('machine_region');

   		$class = new HumanEfficiency();
	    $data = $class->getDataByDate($date,$machine_region);

        //build users
        $data['user'] = array();
	    $users = User::all();
        $users = $users->toArray();
        foreach ($users as $k => $v) {
            $data['user'][$v['id']] = $v;
        }
        //dd($data['user']);

		return view('derbou.humanefficiency.list', [
            'data'       => $data,
            'pageTitle'   => '作業人員效率表',
            'subTitle'    => '清單',
            'breadcrumbs' => $this->getBreadCrumb('index'),
        ]);
   	}
    protected function update(Request $request){
        if('detail'==$request->action){
            $result = HumanEfficiency::updateOrCreate(
                ['data_date'=>$request->date
                ,'time_region'=>$request->time_region
                ,'machine_no'=>$request->machine_no
                ,'machine_region'=>$request->machine_region
                , 'user_id'=>intval($request->user_id)],
                ['yard'=>$request->yard
                , 'kind'=>$request->kind
                , 'memo'=>$request->memo]);
            return response()->json([ 'ok' => true ]);
        }else if('user'==$request->action){
            $result = HumanEfficiency::where('data_date', '=', $request->date)
                ->where('time_region', '=', $request->time_region)
                ->where('machine_region', '=', $request->machine_region)
                ->update(['user_id'=>intval($request->user_id)]);
            return response()->json(['ok' => true ]);
        }else{
            return response()->json(['ok' => false ]);
        }
    }
   	private function getBreadCrumb($page = '', $id = 0)
    {
        $homeBreadCrumb        = new BreadCrumb();
        $homeBreadCrumb->href  = url('/');
        $homeBreadCrumb->title = "首頁";

        $listBreadCrumb        = new BreadCrumb();
        $listBreadCrumb->title = "資料清單";

        switch ($page) {
            case 'index':
                $breadcrumbs = [$homeBreadCrumb, $listBreadCrumb];
                break;
            default:
                $breadcrumbs = [];
                break;
        }

        return $breadcrumbs;
    }
}
