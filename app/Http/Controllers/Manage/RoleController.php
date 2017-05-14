<?php

namespace ERP\Http\Controllers\Manage;

use ERP\Model\BreadCrumb;
use ERP\Model\Role;
use ERP\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected function index()
    {
        // DB::enableQueryLog();
        $roles = DB::table('roles')
            ->select(DB::raw('roles.*, count(role_user.role_id) as members'))
            ->leftJoin('role_user', 'roles.id', '=', 'role_user.role_id')
            ->groupBy('roles.id')
            ->groupBy('roles.name')
            ->groupBy('roles.display_name')
            ->groupBy('roles.description')
            ->groupBy('roles.created_at')
            ->groupBy('roles.updated_at')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd(DB::getQueryLog());
        return View::make('manage.roles.list', [
            'roles'       => $roles,
            'pageTitle'   => '職務管理',
            'subTitle'    => '職務清單',
            'breadcrumbs' => $this->getBreadCrumb('index'),
        ]);
    }
    protected function create()
    {
        return View::make('manage.roles.create', [
            'pageTitle'   => '職務管理',
            'subTitle'    => '新增職務',
            'breadcrumbs' => $this->getBreadCrumb('create'),
        ]);
    }
    protected function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'role_name'    => 'required|max:255',
            'display_name' => 'max:255',
            'description'  => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect('manage/roles/create')
                ->withErrors($validator)
                ->withInput();
        }

        $insertId = Role::create([
            'name'         => $data['role_name'],
            'display_name' => $data['display_name'] ?: null,
            'description'  => $data['description'] ?: null,
        ])->id;

        return redirect()->route('manage.roles.show', ['id' => $insertId]);
    }
    protected function edit($id)
    {
        $role = DB::table('roles')
            ->find($id);

        return View::make('manage.roles.edit', [
            'role'        => $role,
            'pageTitle'   => '職務管理',
            'subTitle'    => '職務編輯',
            'breadcrumbs' => $this->getBreadCrumb('edit', $id),
        ]);
    }
    protected function update(Request $request)
    {
        $data       = $request->all();
        $mId        = $data['id'] or '';

        $validator = Validator::make($data, [
            'role_name'    => 'required|max:255',
            'display_name' => 'max:255',
            'description'  => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect('manage/roles/edit/' . $mId)
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::find($mId);
        $role->name = $data['role_name'];
        $role->display_name = $data['display_name'] ?: null;
        $role->description = $data['description'] ?: null;
        $role->save();

        return redirect()->route('manage.roles.show', ['id' => $mId]);
    }
    protected function show($id)
    {
        $role = DB::table('roles')
            ->find($id);
        // DB::enableQueryLog();
        $users = DB::table('users')
            ->whereIn('id', function ($query) use ($id) {
                $query
                    ->select('user_id')
                    ->from('role_user')
                    ->where('role_id', '=', $id);
            })
            ->get();
        // dd(DB::getQueryLog());
        // dd($users);
        return View::make('manage.roles.show', [
            'role'        => $role,
            'users'       => $users,
            'pageTitle'   => '職務管理',
            'subTitle'    => '職務詳情',
            'breadcrumbs' => $this->getBreadCrumb('show'),
        ]);
    }
    protected function destroy($id)
    {
        $relatedUsers = DB::table('role_user')
            ->where('role_id', '=', $id)
            ->get();
        if (count($relatedUsers)) {
            return redirect('manage/roles/show/' . $id);
        }
        $role = DB::table('roles')
            ->where('id', '=', $id);
        $role->delete();
        return redirect('manage/roles');
    }
    private function getBreadCrumb($page = '', $id = 0)
    {
        $homeBreadCrumb        = new BreadCrumb();
        $homeBreadCrumb->href  = url('/');
        $homeBreadCrumb->title = "首頁";

        $roleCreateBreadCrumb        = new BreadCrumb();
        $roleCreateBreadCrumb->title = "新增職務";

        $roleListBreadCrumb        = new BreadCrumb();
        $roleListBreadCrumb->title = "職務清單";

        $roleShowBreadCrumb        = new BreadCrumb();
        $roleShowBreadCrumb->title = "職務詳情";

        $roleEditBreadCrumb        = new BreadCrumb();
        $roleEditBreadCrumb->title = "職務編輯";

        switch ($page) {
            case 'index':
                $breadcrumbs = [$homeBreadCrumb, $roleListBreadCrumb];
                break;
            case 'create':
                $roleListBreadCrumb->href = url('/manage/roles');
                $breadcrumbs              = [$homeBreadCrumb, $roleListBreadCrumb, $roleCreateBreadCrumb];
                break;
            case 'show':
                $roleListBreadCrumb->href = url('/manage/roles');
                $breadcrumbs              = [$homeBreadCrumb, $roleListBreadCrumb, $roleShowBreadCrumb];
                break;
            case 'edit':
                $roleListBreadCrumb->href = url('/manage/roles');
                $roleShowBreadCrumb->href = url('/manage/roles/show/' . $id);
                $breadcrumbs              = [$homeBreadCrumb, $roleListBreadCrumb, $roleShowBreadCrumb, $roleEditBreadCrumb];
                break;
            default:
                $breadcrumbs = [];
                break;
        }

        return $breadcrumbs;
    }
}
