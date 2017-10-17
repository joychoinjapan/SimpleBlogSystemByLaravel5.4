<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //サイインのページを表示
    public function index()
    {
        return view ('login.index');
    }

    //サイインする
    public function login(Request $request)
    {
        //验证
        $this->validate(request(),[
            'email'=>'required|email',
            'password'=>'required|min:5|max:10',
            'is_remember'=>'integer'
        ]);

        //逻辑
        $user=request(['email','password']);
        $is_remember=boolval(request('is_remember'));
        if(Auth::attempt($user,$is_remember)){
            //渲染
            return redirect('/posts');
        }
        //渲染
        return Redirect::back()->withErrors('邮箱密码不匹配');


    }

    //サインアウト
    public function logout()
    {
        Auth::logout();
        return redirect('/login');

    }
}
