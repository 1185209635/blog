<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // 1. 用户模型关联表
    public $table = 'ew_user';
    // 2. 用户表主键
    public $primaryKey = 'id';

    /**
     * 3. 允许批量操作的字段
     * @var array
     */
    protected $fillable = [
        'username','password'
    ];

    // 4. 禁用模型时间戳
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
