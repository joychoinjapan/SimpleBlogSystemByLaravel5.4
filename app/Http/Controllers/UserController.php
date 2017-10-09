<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //アカウントの詳細を表示
    public function setting()
    {
        return view('user.setting');
    }



    //アカウントの情報を設定
    public function settingStore()
    {

    }
}
