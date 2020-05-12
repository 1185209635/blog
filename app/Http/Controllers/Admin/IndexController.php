<?php
/**
 * Created by PhpStorm.
 * User: Thinkpad
 * Date: 2020/5/12
 * Time: 23:15
 */

namespace App\Http\Controllers\Admin;


class IndexController
{
    public function index(){
        return view('admin/index');
    }
}