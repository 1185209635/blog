<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    @include('admin.public.script')
    @include('admin.public.style')
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>邮箱</label>
                <div class="layui-input-inline">
                    <input type="text" value="{{$user->email}}"  id="L_email" name="email" required="" lay-verify="email" autocomplete="off" class="layui-input"></div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>将会成为您唯一的登入名</div></div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>昵称</label>
                <div class="layui-input-inline">
                    <input type="text" value="{{$user->user_name}}"  id="L_username" name="user_name" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>
                    <input type="hidden" value="{{$user->user_id}}"  id="L_userid" name="user_id" required="" lay-verify="nikid" autocomplete="off" class="layui-input">
            </div>
            {{--<div class="layui-form-item">--}}
                {{--<label for="L_pass" class="layui-form-label">--}}
                    {{--<span class="x-red">*</span>密码</label>--}}
                {{--<div class="layui-input-inline">--}}
                    {{--<input type="password" value="{{$user->user_pass}}"  id="L_pass" name="pass" required="" lay-verify="pass" autocomplete="off" class="layui-input"></div>--}}
                {{--<div class="layui-form-mid layui-word-aux">6到16个字符</div></div>--}}
            {{--<div class="layui-form-item">--}}
                {{--<label for="L_repass" class="layui-form-label">--}}
                    {{--<span class="x-red">*</span>确认密码</label>--}}
                {{--<div class="layui-input-inline">--}}
                    {{--<input type="password" value="{{$user->user_pass}}" id="L_repass" name="repass" required="" lay-verify="repass" autocomplete="off" class="layui-input"></div>--}}
            {{--</div>--}}
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button class="layui-btn" lay-filter="edit" lay-submit="">修改</button></div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                nikename: function(value) {

                    if (value.length < 5) {

                        return '昵称至少得5个字符啊';
                    }
                },
                // pass: [/(.+){6,12}$/, '密码必须6到12位'],
                // repass: function(value) {
                //     if ($('#L_pass').val() != $('#L_repass').val()) {
                //         return '两次密码不一致';
                //     }
                // }
            });

            //监听提交
            form.on('submit(edit)',
                function(data) {
                    console.log(data.field);
                    //发异步，把数据提交给php
                    $.ajax({
                        type:'put',
                        dataType:'json',
                        url:'/admin/user/'+data.field['user_id'],
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:data.field,
                        success:function (data) {
                            // 弹出信息并刷新页面
                            if(data['status'] == 0){
                                    layer.alert(data.message, {
                                            icon: 6
                                        },
                                        function() {
                                            //关闭当前frame
                                            xadmin.close();

                                            // 可以对父窗口进行刷新
                                            xadmin.father_reload();
                                        });
                                }else {
                                    layer.alert(data.message, {
                                            icon: 5
                                        });
                                }


                        },
                        error:function () {
                            // 错误
                        }

                    });

                    return false;
                });

        });</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>