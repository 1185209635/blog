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

Route::get('/', function () {
    return view('welcome');
});
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

// 后台登陆路由
Route::get('/admin/login','Admin\LoginController@login');

// 验证码路由
Route::get('/code/captcha/{tmp}','Admin\LoginController@captcha');
// 登陆表单验证路由
Route::post('/admin/dologin','Admin\LoginController@dologin');

//  首页跳转
Route::get('/admin/index','Admin\indexController@index');

// 加密算法
Route::get('/admin/jiami','Admin\LoginController@jiami');