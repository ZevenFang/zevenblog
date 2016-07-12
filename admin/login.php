<?php
//ajax登陆
if (!empty($_POST)){
    $conf = require '../conf/config.php';
    require '../libs/MysqliDb.php';
    $db = new MysqliDb($conf);
    $name = $_POST['name'];
    $password = md5($_POST['password']);
    $db->where ("name", $name);
    $user = $db->getOne("user");
    if (!$user)
        exit(json_encode(array('code'=>-1,'message'=>'用户名不存在')));
    else if ($user['password']!=$password) {
        exit(json_encode(array('code'=>-2,'message'=>'用户名或密码错误')));
    }
    unset($user['password']);
    session_start();
    $_SESSION['user'] = $user;
    $user['ip'] = $_SERVER["REMOTE_ADDR"];
    $user['login_time'] = time();
    $db->where('id', $user['id']);
    $db->update('user',$user);
    exit(json_encode(array('code'=>1,'data'=>$user,'message'=>'登陆成功')));
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../semantic/dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/jquery.js"></script>
    <script src="../semantic/dist/semantic.min.js"></script>
    <script src="../js/layer/layer.js"></script>

    <style type="text/css">
        body {
            background-color: #DADADA;
        }
        body > .grid {
            height: 100%;
        }
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 450px;
        }
        .ui.header{
            font-family:"微软雅黑" ,"Microsoft Yahei",arial,"Hiragino Sans GB",sans-serif;
        }
    </style>
    <script>
        $(document)
            .ready(function() {
                var form = $('.ui.form');
                form.form({
                    fields: {
                        email: {
                            identifier  : 'name',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : '请输入账户名'
                                }
                            ]
                        },
                        password: {
                            identifier  : 'password',
                            rules: [
                                {
                                    type   : 'empty',
                                    prompt : '请输入密码'
                                }
                            ]
                        }
                    }
                });
                form.submit(function () {
                    var data = {};
                    data.name = $(this).find('[name=name]').val();
                    data.password = $(this).find('[name=password]').val();
                    $.post(location.href,data,function (d) {
                        d = JSON.parse(d);
                        if(d.code==-1)
                            layer.tips(d.message, 'input[name=name]', {
                                tips: [1, 'tomato'],
                                time: 4000
                            });
                        else if(d.code==-2)
                            layer.tips(d.message, 'input[name=password]', {
                                tips: [1, 'tomato'],
                                time: 4000
                            });
                        if (d.code==1)
                            location.href = location.href.replace('login.php','index.php')
                    });
                    return false;
                })
            })
        ;
    </script>
</head>
<body>
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
            <div class="content">
                登录后台
            </div>
        </h2>
        <form class="ui large form">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="name" placeholder="账户名">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="密码">
                    </div>
                </div>
                <div class="ui fluid large teal submit button">Login</div>
            </div>
            <div class="ui error message"></div>
        </form>
    </div>
</div>
</body>
</html>