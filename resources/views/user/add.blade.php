<!doctype html>
<html lang="len">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>添加页面</title>

    </head>
    <body>
         <form action='{{url("/user/store")}}' method="post">
             <table>
                 <tr>
                     {{csrf_field()}}
                     {{--<input type="hidden"name="_token" value="{{csrf_token()}}">--}}
                     <td>用户名</td>
                     <td><input type="text" name="username"></td>
                 </tr>

                 <tr>
                     <td>密码</td>
                     <td><input type="password" name="password"></td>
                 </tr>

                 <tr>
                     <td></td>
                     <td><input type="submit" value="提交"></td>
                 </tr>
             </table>
         </form>
    </body>
</html>
