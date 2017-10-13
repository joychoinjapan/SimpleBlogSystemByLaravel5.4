<?php

namespace App;

use App\Model;

class Comment extends Model
{
   //a post has many comments
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    //a user has many comments
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
