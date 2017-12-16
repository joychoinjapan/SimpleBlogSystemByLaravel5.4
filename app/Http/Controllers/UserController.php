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


    //个人中心页面
    public function show(User $user)
    {
        //这个人的信息：用户名，头像，关注，粉丝文章数。
        $user=User::withCount(['stars','fans','posts'])->find($user->id);

        //这个人的文章列表，取创建时间最新的前十条。
        $posts=$user->posts()->orderBy('created_at','desc')->take(10)->get();

        //这个人关注的用户，返回的是每个用户的信息。
        $stars=$user->stars;
        $susers=User::whereIn('id',$stars->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        //这个人的粉丝，粉丝用户的文章数。
        $fans=$user->fans;
        $fusers=User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user/show',compact('user','posts','susers','fusers'));
    }

    //关注用户
    public function fan(User $user)

    {
        $me=Auth::user();
        $me->doFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];
    }

    //取消关注
    public function unfan(Uer $user)
    {
        $me=Auth::user();
        $me->doUnfan($user->id);
        return [
        'error'=>0,
        'msg'=>''
        ];
    }
}
