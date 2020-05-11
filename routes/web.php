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

