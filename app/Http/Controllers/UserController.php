<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * 获取一个添加方法
     * @param null
     * @return  返回添加页面
     */
    public function add(){
       return view('user.add');
    }

    /**
     * 获取一个添加方法
     * @param 提交表单数据
     * @return  返回添加是否成功
     */
    public function store(Request $request){
        // 1. 获取客户端提交的表单数据
        $input = $request ->except('_token');
        $input['password'] = md5($input['password']);

        // 2. 表单验证
        // 3. 添加操作
        $res = User::create($input);

        // dd($res->password);
        // 4. 如果跳转成功，跳转到成功页面，如果添加失败，跳转回与那页面
        if($res){
            return redirect('user/index');
        }else {
            return back();
        }
    }

    /**
     *
     * @param null
     * @return  用户列表
     */
    public function index(){
        // 1 . 获取用户数据
        $user =  User::get();
        // 2. 返回用户列表
//        return view('user.list',['user'=> $user]);
//        return view('user.list')->with('user',$user);
        return view('user.list',compact('user'));
    }


    /**
     * 修改界面
     * @param $id
     */
    public function  edit($id){

        // 1. 根据id找到用户
        $user = User::find($id);
        // 2. 返回用户修改页面
        return view('user.edit',compact('user'));
    }

    /**
     * 修改确认操作
     * @param Request $request
     */
    public function update(Request $request){

        // 1. 接收用户信息
        $input = $request ->except('_token');
        // dd($input);
        $user = User::find($input['id']);
        // 2. 将提交过来的用户名替换掉原来的用户名
        $res = $user ->update(['username'=>$input['username'],'password'=>md5($input['password'])]);

        // 3. 根据是否跳转成功，跳转到对应页面
        if($res){
            return redirect('/user/index');
        } else {
            return back();
        }

    }

    /**
     * 删除确认操作
     * @param $id
     */
    public function delete($id){
        // 1. 根据id找到用户
        $user = User::find($id);

        // 2. 删除选中的数据
        $res = $user->delete();

        // 3. 返回信息
        if ($res){

            $data = [
                'status'=>0,
                'massage'=>'删除成功'
            ];
        } else {
            $data = [
                'status'=>-1,
                'massage'=>'删除失败'
            ];

        }

        return $data;
    }
}
