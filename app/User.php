<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //获取用户的文章
    public function posts()
    {
        return $this->hasMany(Post::class,'user_id','id');
    }

    //获得关注我的粉丝
    public function fans()
    {
        return $this->hasMany(Fan::class,'star_id','id');
    }

    //获得我关注的人
    public function stars()
    {
        return $this->hasMany(Fan::class,'fan_id','id');
    }

    //关注某人
    public function doFan($uid)
    {
        $fan=new Fan();
        $fan->star_id=$uid;
        return $this->stars()->save($fan);
    }

    //取消关注
    public function doUnfan($uid)
    {
        $fan=new Fan();
        $fan->star_id=$uid;
        return $this->stars()->delete($fan);
    }
    //当前用户是否被uid关注了
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前用户是否关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }


}
