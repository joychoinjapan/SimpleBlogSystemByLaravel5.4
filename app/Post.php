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
}
