<?php
/**
 * Created by PhpStorm.
 * User: Thinkpad
 * Date: 2020/5/12
 * Time: 23:15
 */

namespace App\Http\Controllers\Admin;


use mysql_xdevapi\Session;

class IndexController
{
    public function index(){
        return view('admin/index');
    }

    public function welcome(){
        return view('admin/welcome');
    }

    public  function  logout(){
        // 1. 清空session
        Session()->flush();
        // return view('admin/login');
        return redirect('admin/login');
    }
}