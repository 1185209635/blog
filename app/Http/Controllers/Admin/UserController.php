<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * 获取用户列表
     *  admin/user
     *  get
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $user = User::orderBy('user_id','ase')
            ->where(function ($query) use($request){
                $username = $request->input('username');
                $email = $request->input('email');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }

                if(!empty($email)){
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num')|3);

        // 分页获取
//        $user = User::paginate(1);
        return view('admin/user/list',compact('user','request'));
    }

    /**
     * 返回用户添加页面
     *  admin/user/create
     *  get
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/user/add');
    }

    /**
     * 执行添加操作
     *  admin/user
     *  post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. 接收前台表单提交的数据
        $input = $request->all();

        // 2. 进行表单验证

        // 3. 添加到数据库
        $username = $input['username'];
        $pass =Crypt::encrypt($input['pass']);

        $res = User::create([
            'user_name'=>$username,
            'user_pass'=>$pass,
            'email'=>$input['email']]);
        // 4. 根据添加结果返回数据
        if($res){
            $data = [
                "status"=>0,
                "message"=>"添加成功",
            ];
        } else {
            $data = [
                "status"=>1,
                "message"=>"添加失败",
            ];
        }
        return $data;
    }

    /**
     * 显示一条数据
     *  admin/user/{user}
     *  get
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * 返回一个修改页面
     *  admin/user/{user}/edit
     *  get
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 1. 根据id获取数据
        $user = User::find($id);
        // 2. 返回数据到修改页面
        return view('admin/user/edit',compact('user'));
    }

    /**
     * 执行一个修改操作
     *  admin/user/{user}
     *  put
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 1. 获取要修改的值
        $user = User::find($id);
        // 2. 获取要修改成的用户名
        $username = $request->input('user_name');
        $email = $request->input('email');
        $user->user_name = $username;
        $user->email = $email;
        $res= $user->save();

        if($res){
            $data = [
                'status'=>'0',
                'message'=>'修改成功',
            ];
        } else {
            $data = [
                'status'=>'1',
                'message'=>'修改失败',
            ];
        }

        return $data;
    }

    /**
     * 执行删除操作
     *  admin/user/{user}
     *  delete
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 1. 根据id获取删除的用用
        $user = User::find($id);
        // 2. 删除并返回信息
        $res=$user->delete();

        if($res){
            $data = [
                'status'=>'0',
                'message'=>'删除成功',
            ];
        } else {
            $data = [
                'status'=>'1',
                'message'=>'删除失败',
            ];
        }

        return $data;
    }


    /**
     *  删除所有操作
     *  admin/user/del
     *  delete
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delAll(Request $request)
    {
        // 1. 获取需要删除的id
        $input = $request->input('ids');
        // 2. 删除并返回信息
        $res= User::destroy($input);

        if($res){
            $data = [
                'status'=>'0',
                'message'=>'删除成功',
            ];
        } else {
            $data = [
                'status'=>'1',
                'message'=>'删除失败',
            ];
        }

        return $data;
    }
}
