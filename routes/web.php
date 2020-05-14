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
/**
 * 这些是数据库lmonkey的数据处理
 */
// 用户添加路由
Route::get('/user/add','UserController@add');
// 用户添加操作
Route::post('/user/store','UserController@store');
// 用户列表页
Route::get('/user/index','UserController@index');
// 修改用户数据
Route::get('/user/edit/{id}','UserController@edit');
// 用户修改操作
Route::post('/user/update','UserController@update');
// 删除用户数据
Route::get('/user/delete/{id}','UserController@delete');


/**
 * 这些是数据库boke的数据处理
 */

// 验证码路由
Route::get('/code/captcha/{tmp}','Admin\LoginController@captcha');

Route::group(
    ['prefix'=>'admin','namespace'=>'Admin'],
    function (){
        // 后台登陆路由
        Route::get('login','LoginController@login');
        // 登陆表单验证路由
        Route::post('dologin','LoginController@dologin');
        // 加密算法
        Route::get('jiami','LoginController@jiami');
});


// 需要验证是否登陆的页面
Route::group(
    ['prefix'=>'admin','namespace'=>'Admin','middleware'=>'isLogin'],
    function (){
    //  首页跳转
    Route::get('index','indexController@index');
    //  欢迎界面
    Route::get('welcome','indexController@welcome');
    // 退出登录
    Route::get('/logout','indexController@logout');

    // 后台用户模块相关路由
        //批量删除
    Route::post('/user/del','UserController@delAll');
    Route::resource('user','UserController');
});


