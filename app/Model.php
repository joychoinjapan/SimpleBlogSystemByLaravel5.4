<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

//设定model可注入字段的基础类
class Model extends BaseModel{
    //
    protected $guarded=[];
}
