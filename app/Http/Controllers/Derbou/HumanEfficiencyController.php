<?php

namespace ERP\Http\Controllers\Derbou;

use ERP\Model\BreadCrumb;
use ERP\Model\User;
use ERP\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use ERP\Model\HumanEfficiency;

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
	    $data['user'] = User::all();

		return view('derbou.humanefficiency.list', [
            'data'       => $data,
            'pageTitle'   => '作業人員效率表',
            'subTitle'    => '清單',
            'breadcrumbs' => $this->getBreadCrumb('index'),
        ]);
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
