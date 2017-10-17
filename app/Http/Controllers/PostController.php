<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use \App\Post;
use Illuminate\Support\Facades\Auth;
use \App\zan;

class PostController extends Controller
{
    // 文章のページを表示
    public function index(){
        //新たしい文章上に並ぶ,$postsは幾つかのオブジェクトを格納する配列です
        $posts=Post::orderBy('created_at','desc')->withCount(["comments",'zans'])->paginate(6);
        return view("post/index",compact('posts'));

    }
    // 呈现文章详情
    public function show(Post $post){
        $post->load('comments');
        return view('post/show',compact('post'));
    }
    //创建文章页面
    public function create(){
        return view('post/create');
    }
    //保存提交文章
    public function store(){
        //验证操作
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);
        //逻辑

        //把用户也保存在文章里
        $user_id=Auth::id();
        $params=array_merge(request(['title','content']),compact('user_id'));
        $post=Post::create($params);
        //页面的渲染
        return redirect('/posts');
    }
    //编辑文章页面
    public function edit(Post $post){
        return view('post/edit',compact('post'));
    }
    //提交更新文章
    public function update(Post $post){
        //用户权限认证
        $this->authorize('update',$post);

        //验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);
        //逻辑
        $post->title=request('title');
        $post->content=request('content');

        $post->save();
        //渲染
        return redirect("/posts/{$post->id}");
    }
    //删除文章
    public function delete(Post $post){
        //用户权限认证
        $this->authorize('delete',$post);


        $post->delete();
        return redirect('/posts');
    }

    //上传图片
    public function imageUpload(Request $request){
        //request->file 为获取一个文件 ->storePublicly包存一个文件的文件名重新命名，使用时间戳
        $path=$request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'. $path);
    }



    //提交评论
    public function comment(Post $post)
    {
        //验证
        $this->validate(request(),[
            'content'=>'required|min:3'
        ]);

        //逻辑
        $comment=new Comment();
        $comment->user_id=Auth::id();
        $comment->content=request('content');
        $post->comments()->save($comment);

        //渲染
        return back();

    }



    //いいね
    public function zan(Post $post)
    {
        $param=[
            'user_id'=>Auth::id(),
            'post_id'=>$post->id,
        ];
        Zan::firstOrCreate($param);
        return back();
    }


    //いいねを取り消す
    public function unzan(Post $post)
    {
        $post->zan(Auth::id())->delete();
        return back();
    }
}
