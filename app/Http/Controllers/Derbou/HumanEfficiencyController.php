<?php

namespace ERP\Http\Controllers\Derbou;

use ERP\Model\BreadCrumb;
use ERP\Model\Role;
use ERP\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HumanEfficiencyController extends Controller
{
   	protected function index(Request $request){
   		$date = ($request->input('date')==null) ? dateadd(config('const.today'),-1) : $request->input('date');
   		$time_region = ($request->input('date')==null) ? dateadd(config('const.today'),-1) : $request->input('date');
   		
   		$data = array();
		return view('derbou.humanefficiency.list', [
            'datas'       => $data,
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

        $createBreadCrumb        = new BreadCrumb();
        $createBreadCrumb->title = "新增資料";

        $listBreadCrumb        = new BreadCrumb();
        $listBreadCrumb->title = "資料清單";

        $showBreadCrumb        = new BreadCrumb();
        $showBreadCrumb->title = "資料詳情";

        $editBreadCrumb        = new BreadCrumb();
        $editBreadCrumb->title = "資料編輯";

        switch ($page) {
            case 'index':
                $breadcrumbs = [$homeBreadCrumb, $listBreadCrumb];
                break;
            case 'create':
                $listBreadCrumb->href = url('/derbou/humanefficiency');
                $breadcrumbs              = [$homeBreadCrumb, $listBreadCrumb, $createBreadCrumb];
                break;
            case 'show':
                $listBreadCrumb->href = url('/derbou/humanefficiency');
                $breadcrumbs              = [$homeBreadCrumb, $listBreadCrumb, $showBreadCrumb];
                break;
            case 'edit':
                $listBreadCrumb->href = url('/derbou/humanefficiency');
                $showBreadCrumb->href = url('/derbou/humanefficiency/show/' . $id);
                $breadcrumbs              = [$homeBreadCrumb, $listBreadCrumb, $showBreadCrumb, $editBreadCrumb];
                break;
            default:
                $breadcrumbs = [];
                break;
        }

        return $breadcrumbs;
    }
}
