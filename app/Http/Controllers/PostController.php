<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 呈现文章列表页面
    public function index(){
        $posts=[
            ['title'=>'this is title1',],
            ['title'=>'this is title2',],
            ['title'=>'this is title3',],
            ['title'=>'this is title4',]

        ];
        return view("post/index",compact('posts'));

    }
    // 呈现文章详情
    public function show(){
        return view('post/show',['title'=>'this is title','isShow'=>false]);
    }
    //创建文章页面
    public function create(){
        return view('post/create');
    }
    //保存提交文章
    public function store(){
        return;
    }
    //编辑文章页面
    public function edit(){
        return view('post/edit');
    }
    //提交更新文章
    public function update(){
        return view();
    }
    //删除文章
    public function delete(){
        return view();
    }
}
