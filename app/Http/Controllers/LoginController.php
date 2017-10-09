<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //サイインのページを表示
    public function index()
    {
        return view ('login.index');
    }

    //サイインする
    public function login()
    {
        //验证

        //逻辑

        //渲染

    }

    //サインアウト
    public function logout()
    {

    }
}
