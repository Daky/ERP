<?php

namespace ERP\Http\Controllers\Manage;

use ERP\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use ERP\BreadCrumb;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DB::enableQueryLog();
        $users = DB::table('users')
                    ->select(DB::raw('users.*, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name'))
                    ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                    ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                    ->orderBy('users.created_at', 'DESC')
                    ->paginate(10);
        // dd(DB::getQueryLog());
        return View::make('manage.users.list', [
            'users'       => $users,
            'pageTitle'   => '帳號管理',
            'subTitle'    => '帳號清單',
            'breadcrumbs' => $this->getBreadCrumb('index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = DB::table('users')
                    ->select(DB::raw('users.*, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name'))
                    ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                    ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('users.id', '=', $id)
                    ->first();
        return View::make('manage.users.show', [
            'user'        => $user,
            'pageTitle'   => '帳號管理',
            'subTitle'    => '帳號詳情',
            'breadcrumbs' => $this->getBreadCrumb('show')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = DB::table('users')
                    ->select(DB::raw('users.*, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name'))
                    ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                    ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('users.id', '=', $id)
                    ->first();
        return View::make('manage.users.edit', [
            'user'        => $user,
            'pageTitle'   => '帳號管理',
            'subTitle'    => '帳號編輯',
            'breadcrumbs' => $this->getBreadCrumb('edit', $id)
        ]);
    }

    private function getBreadCrumb($page = '', $id = 0) {

        $homeBreadCrumb        = new BreadCrumb();
        $homeBreadCrumb->href  = url('/');
        $homeBreadCrumb->title = "首頁";

        $userListBreadCrumb        = new BreadCrumb();
        $userListBreadCrumb->title = "帳號清單";

        $userShowBreadCrumb        = new BreadCrumb();
        $userShowBreadCrumb->title = "帳號詳情";

        $userEditBreadCrumb        = new BreadCrumb();
        $userEditBreadCrumb->title = "帳號編輯";

        switch ($page) {
            case 'index':
                $breadcrumbs = [$homeBreadCrumb, $userListBreadCrumb];
                break;
            case 'show':
                $userListBreadCrumb->href = url('/manage/users');
                $breadcrumbs = [$homeBreadCrumb, $userListBreadCrumb, $userShowBreadCrumb];
                break;
            case 'edit':
                $userListBreadCrumb->href = url('/manage/users');
                $userShowBreadCrumb->href = url('/manage/users/show/' . $id);
                $breadcrumbs = [$homeBreadCrumb, $userListBreadCrumb, $userShowBreadCrumb, $userEditBreadCrumb];
                break;
            default:
                $breadcrumbs = [];
                break;
        }

        return $breadcrumbs;
    }
}