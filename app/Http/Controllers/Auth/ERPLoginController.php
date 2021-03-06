<?php

namespace ERP\Http\Controllers\Auth;

use Illuminate\Http\Request;
use ERP\Http\Controllers\Controller;
use ERP\Model\Manage\User;
use Session;

class ERPLoginController extends Controller
{
    //
    public function showLoginForm(){
    	return view('auth.login');
    }

    public function login(Request $req){
    	$input = $req->all();
    	$account = isset($input['account'])?$input['account']:'';
    	$password = isset($input['password'])?$input['password']:'';

    	$user = User::where(['account'=>$account , 'password'=>$password])->first();
    	
    	if($user == null){
    		//return view('errors.404');
            return redirect()->route('login');
    	}

        session(['user.id'=>$user['id']]);
    	session(['user.account'=>$user['account']]);
    	session(['user.email'=>$user['email']]);
    	session(['user.name'=>$user['name']]);
        session(['user.avatar'=>$user['avatar']]);
        session(['user.created_at'=>$user['created_at']]);

    	return redirect('/');
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }
}
