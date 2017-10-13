<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*
 * module:user
 */

//アカウントを作成のページを表示
Route::get('/register','RegisterController@index');

//アカウントの作成する
Route::post('/register','RegisterController@register');

//サイインのページを表示
Route::get('/login','LoginController@index');

//サイインする
Route::post('/login','LoginController@login');

//サイインアウトする
Route::get('/logout','LoginController@logout');

//アカウントの詳細を表示
Route::get('/user/me/setting','UserController@setting');

//アカウントの情報を設定
Route::post('/user/me/setting','UserController@settingStore');



/*
 * module:post
 */

Route::get('/', function () {
    return view('welcome');
});

//文章列表页
Route::get('/posts','PostController@index');



//图片上传
Route::post('/posts/image/upload','PostController@imageUpload');

//创建文章 1.页面 2. 提交
Route::get('/posts/create','PostController@create');
Route::post('/posts','PostController@store');

//文章详情
Route::get('/posts/{post}','PostController@show');



//编辑文章  1.页面 2. 提交
Route::get('/posts/{post}/edit','PostController@edit');
Route::put('/posts/{post}','PostController@update');
//删除文章
Route::get('/posts/{post}/delete','PostController@delete');


/*
 * module:comment
 */
Route::post('/posts/{post}/comment','PostController@comment');

