<!doctype html>
<html lang="len">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>用户列表</title>
    <script src="/js/layer/jquery-3.2.1.js"></script>
    <script src="/js/layer/layer.js"></script>
</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>用户名</td>
            <td>密码</td>
            <td>操作</td>
        </tr>

        @foreach($user as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->password}}</td>
            <td>
                <a href="/user/edit/{{$v->id}}">修改</a>|
                <a href="javascript:;" onclick="del_member(this,{{$v->id}})" >删除</a>
            </td>
        </tr>
        @endforeach
    </table>

</form>
</body>
<script>
    // 删除用户
    function del_member(obj,id) {
        //询问框

        layer.confirm('是否确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            $.get('/user/delete/'+id,function (data) {

                if(data.status==0){
                    $(obj).parents('tr').remove();
                    layer.msg(data.massage, {icon: 6});
                }else {
                    layer.msg(data.massage, {icon: 5});
                }

            });

            // layer.msg('的确很重要', {icon: 1});
        }, function(){

        });
    }
</script>
</html>
