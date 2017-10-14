<?php

namespace App;

use App\Model;
//表->posts

class Post extends Model
{

    //link with user
    public function user()
    {
        return $this->belongsTo('App\User');

    }

    //get comment model
    public function comments()
    {
        return $this->hasMany('App\comment')->orderBy('created_at','desc');
    }

    //connect with user
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    //get all zans of post
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }
}
