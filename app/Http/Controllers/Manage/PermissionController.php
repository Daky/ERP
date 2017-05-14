<?php

namespace ERP\Http\Controllers\Manage;

use ERP\Model\BreadCrumb;
use ERP\Model\Role;
use ERP\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    protected function index()
    {
        // DB::enableQueryLog();
        $permissions = DB::table('permissions')
            ->select(DB::raw('permissions.*, count(permission_role.role_id) as roles'))
            ->leftJoin('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
            ->groupBy('permissions.id')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd(DB::getQueryLog());
        return View::make('manage.permissions.list', [
            'permissions'       => $permissions,
            'pageTitle'   => '權限管理',
            'subTitle'    => '權限清單',
            'breadcrumbs' => $this->getBreadCrumb('index'),
        ]);
    }

    private function getBreadCrumb($page = '', $id = 0)
    {
        $homeBreadCrumb        = new BreadCrumb();
        $homeBreadCrumb->href  = url('/');
        $homeBreadCrumb->title = "首頁";

        $createBreadCrumb        = new BreadCrumb();
        $createBreadCrumb->title = "新增權限";

        $listBreadCrumb        = new BreadCrumb();
        $listBreadCrumb->title = "權限清單";

        $showBreadCrumb        = new BreadCrumb();
        $showBreadCrumb->title = "權限詳情";

        $editBreadCrumb        = new BreadCrumb();
        $editBreadCrumb->title = "權限編輯";

        switch ($page) {
            case 'index':
                $breadcrumbs = [$homeBreadCrumb, $listBreadCrumb];
                break;
            case 'create':
                $listBreadCrumb->href = url('/manage/permissions');
                $breadcrumbs              = [$homeBreadCrumb, $listBreadCrumb, $createBreadCrumb];
                break;
            case 'show':
                $listBreadCrumb->href = url('/manage/permissions');
                $breadcrumbs              = [$homeBreadCrumb, $listBreadCrumb, $showBreadCrumb];
                break;
            case 'edit':
                $listBreadCrumb->href = url('/manage/permissions');
                $showBreadCrumb->href = url('/manage/permissions/show/' . $id);
                $breadcrumbs              = [$homeBreadCrumb, $listBreadCrumb, $showBreadCrumb, $editBreadCrumb];
                break;
            default:
                $breadcrumbs = [];
                break;
        }

        return $breadcrumbs;
    }
}
