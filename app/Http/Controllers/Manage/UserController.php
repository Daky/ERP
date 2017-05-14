<?php

namespace ERP\Http\Controllers\Manage;

use ERP\Model\BreadCrumb;
use ERP\Http\Controllers\Controller;
use ERP\Model\RoleUser;
use ERP\Model\User;
use ERP\Model\UserDisabled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
    */ 
    public function __construct()
    {
        //$this->middleware('auth');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function index()
    {
        DB::enableQueryLog();

        $users = DB::table('users')
            ->select(DB::raw('users.*, roles.id AS role_id, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name'))
            ->where('users.id', '!=', '1')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->orderBy('users.created_at', 'DESC')
            ->paginate(10);
        //dd(DB::getQueryLog());

        return View::make('manage.users.list', [
            'users'       => $users,
            'pageTitle'   => '帳號管理',
            'subTitle'    => '帳號清單',
            'breadcrumbs' => $this->getBreadCrumb('index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {

        $roles = DB::table('roles')
            ->select(DB::raw('roles.*, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name'))
            ->get();

        return View::make('manage.users.create', [
            'roles'       => $roles,
            'pageTitle'   => '帳號管理',
            'subTitle'    => '新增帳號',
            'breadcrumbs' => $this->getBreadCrumb('create'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return Redirect
     */
    protected function store(Request $request)
    {
        $data = $request->all();

        

        $validator = Validator::make($data, [
            'name'    => 'required|max:255',
            'account' => 'required|max:20|unique:users',
            'email'   => 'required|email',
            'password'=> 'required',
            'avatar'  => config('const.avatar_mime_limit') . '|max:' . config('const.avatar_max_size'),
        ]);

        if ($validator->fails()) {
            return redirect('manage/users/create')
                ->withErrors($validator)
                ->withInput();
        }

        $mAvatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            if ($avatar->isValid()) {
                $mAvatar = $avatar->storePublicly('avatars');
                $this->avatarImgProcess($mAvatar);
            }
        }

        $insertId = User::create([
            'name'     => $data['name'],
            'account'  => $data['account'],
            'email'    => $data['email'],
            'password' => $data['password'],
            'avatar'   => $mAvatar,
        ])->id;

        $roleUser          = new RoleUser;
        $roleUser->role_id = $data['roles'];
        $roleUser->user_id = $insertId;
        $roleUser->save();

        return redirect()->route('manage.users.show', ['id' => $insertId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    protected function edit($id)
    {
        // DB::enableQueryLog();

        $roles = DB::table('roles')
            ->select(DB::raw('roles.*, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name, (role_user.role_id IS NOT NULL AND role_user.user_id IS NOT NULL) AS checked'))
            ->leftJoin('role_user', function ($join) use ($id) {
                $join
                    ->on('role_user.role_id', '=', 'roles.id')
                    ->where('role_user.user_id', '=', $id);
            })
            ->get();

        // dd(DB::getQueryLog());

        $user = DB::table('users')
            ->select(DB::raw('users.*, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name'))
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id', '=', $id)
            ->first();

        return View::make('manage.users.edit', [
            'roles'       => $roles,
            'user'        => $user,
            'pageTitle'   => '帳號管理',
            'subTitle'    => '帳號編輯',
            'breadcrumbs' => $this->getBreadCrumb('edit', $id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Redirect
     */
    protected function update(Request $request)
    {

        $data       = $request->all();
        $mId        = $data['id'] or '';
        $mPassword  = $data['password'] or '';
        $mConfirmed = $data['password_confirmation'] or '';

        $validator = Validator::make($data, [
            'id'       => 'required|integer',
            'name'     => 'required|max:255',
            'account'  => 'required|max:20|unique:users,account,' . $mId,
            'email'    => 'required|email',
            'avatar'   => config('const.avatar_mime_limit') . '|max:' . config('const.avatar_max_size'),
            'password' => ((!empty($mPassword) || !empty($mConfirmed)) ? 'required|' : '') . 'min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('manage/users/edit/' . $mId)
                ->withErrors($validator)
                ->withInput();
        }

        $mAvatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            if ($avatar->isValid()) {
                $mAvatar = $avatar->storePublicly('avatars');
                $this->avatarImgProcess($mAvatar);
            }
        }

        $user          = User::find($mId);
        $user->account = $data['account'];
        $user->name    = $data['name'];
        $user->email   = $data['email'];
        $remove_avatar = isset($data['remove_avatar']) ? $data['remove_avatar'] : '0';
        if (!is_null($mAvatar)) {
            $user->avatar = $mAvatar;
        } elseif ($remove_avatar == '1') {
            $user->avatar = null;
        }
        if (!empty($mPassword)) {
            $user->password = bcrypt($mPassword);
        }
        $user->save();

        $roleUser = RoleUser::where('user_id', '=', $mId);
        $roleUser->delete();

        $roleUser          = new RoleUser;
        $roleUser->role_id = $data['roles'];
        $roleUser->user_id = $mId;
        $roleUser->save();

        if ($mId == session('user.id') && !empty($mPassword)) {
            return redirect()->route('logout');
        }
        return redirect()->route('manage.users.show', ['id' => $mId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    protected function show($id)
    {
        $user = DB::table('users')
            ->select(DB::raw('users.*, roles.id AS role_id, IF (roles.display_name IS NOT NULL, roles.display_name, roles.name) AS role_name'))
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id', '=', $id)
            ->first();

        return View::make('manage.users.show', [
            'user'        => $user,
            'pageTitle'   => '帳號管理',
            'subTitle'    => '帳號詳情',
            'breadcrumbs' => $this->getBreadCrumb('show'),
        ]);
    }

    protected function disable($id)
    {
        $user = DB::table('users')->where('users.id', '=', $id);
        $data = (array) $user->first();
        UserDisabled::insert($data);
        $user->delete();
        return redirect()->route('manage.users.list');
    }

    private function getBreadCrumb($page = '', $id = 0)
    {

        $homeBreadCrumb        = new BreadCrumb();
        $homeBreadCrumb->href  = url('/');
        $homeBreadCrumb->title = "首頁";

        $userCreateBreadCrumb        = new BreadCrumb();
        $userCreateBreadCrumb->title = "新增帳號";

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
            case 'create':
                $userListBreadCrumb->href = url('/manage/users');
                $breadcrumbs              = [$homeBreadCrumb, $userListBreadCrumb, $userCreateBreadCrumb];
                break;
            case 'show':
                $userListBreadCrumb->href = url('/manage/users');
                $breadcrumbs              = [$homeBreadCrumb, $userListBreadCrumb, $userShowBreadCrumb];
                break;
            case 'edit':
                $userListBreadCrumb->href = url('/manage/users');
                $userShowBreadCrumb->href = url('/manage/users/show/' . $id);
                $breadcrumbs              = [$homeBreadCrumb, $userListBreadCrumb, $userShowBreadCrumb, $userEditBreadCrumb];
                break;
            default:
                $breadcrumbs = [];
                break;
        }

        return $breadcrumbs;
    }

    protected function avatarImgProcess($avatarPath)
    {
        $avatar = Image::make(storage_path('app') . '/' . $avatarPath)
            ->orientate()
            ->fit(160)
            ->save();
    }
}
