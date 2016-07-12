<?php include 'header.php'?>
<?php
if (!empty($_POST)){
    $conf = require '../conf/config.php';
    require '../libs/MysqliDb.php';
    $db = new MysqliDb($conf);
    $data = $_POST;
    $data['password'] = md5($_POST['password']);
    $data['ip'] = $_SERVER["REMOTE_ADDR"];
    $data['login_time'] = time();
    unset($data['repwd']);
    $db->insert('user',$data);
    header('location:step3.php');
}
?>
<div class="ui main container">
    <div class="ui ordered steps">
        <div class="completed step">
            <div class="content">
                <div class="title">设置数据库</div>
                <div class="description">设置数据库账户和密码</div>
            </div>
        </div>
        <div class="active step">
            <div class="content">
                <div class="title">设置管理员</div>
                <div class="description">设置管理员账户和密码</div>
            </div>
        </div>
        <div class="step">
            <div class="content">
                <div class="title">安装完成</div>
                <div class="description">成功安装系统</div>
            </div>
        </div>
    </div>
    <div class="ui divider"></div>
    <div class="ui four column grid">
        <div class="two column row">
            <div class="column">
                <form class="ui form" method="post">
                    <div class="field">
                        <label for="name">用户名</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="field">
                        <label for="nickname">昵称</label>
                        <input type="text" name="nickname" id="nickname" required>
                    </div>
                    <div class="field">
                        <label for="password">密码</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field">
                        <label for="repwd">重复密码</label>
                        <input type="password" name="repwd" id="repwd" required>
                    </div>
                    <button class="ui button large" type="submit">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.ui.form').submit(function () {
        var password = $('#password').val();
        var repwd = $('#repwd').val();
        var opt = {
            tips: [1, 'tomato'],
            time: 4000
        };
        if (password!=repwd) {
            layer.tips('输入的两次密码不一致', 'label[for=repwd]', opt);
            return false;
        }
        return true;
    })
</script>