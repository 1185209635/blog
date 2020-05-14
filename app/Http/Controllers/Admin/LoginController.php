<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpMyAdmin\Session;

class LoginController extends Controller
{
    // 后台登陆页
    public function login(){
        return view('admin/login');
    }

    // 获取验证码图形
    public function captcha($tmp){
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase -> build(6);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code,$phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220,210,230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高和字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码内容
        $phrase = $builder -> getPhrase();
        // 把内容存入session
        \Session::flash('code',$phrase);
        // 生成图片
        header('Cache-Contro:no-cache,must-revalidate');
        header('Content-Type:image/jpeg');
        $builder->output();

    }

    /**
     * 存储新的博客文章
     *
     * @param  Request  $request
     * @return Response
     */
    public function dologin(Request $request)
    {

        // 1. 接收提交表单
        $input = $request->except('_token');

        // 2. 进行表单验证
        // $validator = Validator::make('需要验证的表单数据','验证规则','错误提示信息');
        $rule = [
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18|alpha_dash'
        ];

        $msg = [
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名长度必须在4到18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码长度必须在4到18位之间',
            'password.alpha_dash'=>'密码必须是数字字母下划线',
        ];

        $validator = Validator::make($input, $rule,$msg);

        if ($validator->fails()) {
            // 验证失败切换页面
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        // 3. 验证是否有此用户（用户名，密码，验证码）

        // 获取user对象
        $un =User::where('user_name',$input['username'])->first();
        if(!$un){
            return redirect('admin/login')->with('errors','用户不存在');
        }

        // 解密并比对
        $up = $un->user_pass;
        if(Crypt::decrypt($up)!= $input['password']){
            return redirect('admin/login')
                ->with('errors','密码错误');
        }

        // 验证码验证
        if(strtolower($input['captcha']) != strtolower(Session() ->get('code'))){
            return redirect('admin/login')
                ->with('errors','验证码错误');
        }

        // 4. 保存信息到session中
        \session()->put('user',$un);
        // Session()->put('user',$un);

        // 5. 跳转到后天首页
        return redirect('admin/index');
    }

    // 加密demo
    public function jiami(){
        // 1. md5加密
        $str ='admin123';
        // return md5($str);

        // 2. 哈希加密
//        $hash = Hash::make($str);
//        if(Hash::check($str,$hash)){
//            return '正确';
//        }else {
//            return '错误';
//        }

        // 3. crypt加密
        // $crypt_str= Crypt::encrypt($str);
        $crypt_str= 'eyJpdiI6IkNGQ3RnMXI3QlBXNmxJUG9meXA5eWc9PSIsInZhbHVlIjoiY240dFI5YVVYRE40YzRjKzVtaDFUZ
        z09IiwibWFjIjoiZmUyZGNlMzhlMDYyMDA3OTI1NWRkZWMyN2QyYTFlYTk3MDVlMDVjNzYzYmM4YjhiNGI3YzExODIzNjc0
        ODBmZCJ9';
        // 解密
        if(Crypt::decrypt($crypt_str)== $str){
            return 'yes';
        } else {
            return "no";
        }

    }

}
