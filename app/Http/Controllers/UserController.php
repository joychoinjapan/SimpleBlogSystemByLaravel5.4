<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{
    //アカウントの詳細を表示
    public function setting()
    {
        $user=Auth::user();
        return view('user.setting',compact('user'));
    }



    //アカウントの情報を設定
    public function settingStore(Request $request)
    {
        //验证
        $this->validate(request(),[
           'name'=>'required|min:3',
        ]);

        //逻辑
        $name=request('name');
        $user=Auth::user();
        if($name!=$user->name){
            if(User::where('name',$name)->count()>0){
                return back()->withErrors('用户名已经被注册');
            }
            $user->name=$name;

        }
        if($request->file('avatar')){
            $path=$request->file('avatar')->storePublicly($user->id);
            $user->avatar="/storage/".$path;
        }

        //渲染
        $user->save();
        return back();



    }
}
