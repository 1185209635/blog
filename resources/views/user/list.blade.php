<!doctype html>
<html lang="len">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>用户列表</title>

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
                <a href="/user/delete/{{$v->id}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>

</form>
</body>
</html>
