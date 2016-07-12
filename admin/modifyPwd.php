<?php
if (!empty($_POST)){
    session_start();
    $conf = require '../conf/config.php';
    require '../libs/MysqliDb.php';
    $db = new MysqliDb($conf);
    $db->where('id',$_SESSION['user']['id']);
    $user = $db->getOne('user');
    if ($user['password']!=md5($_POST['oldPwd']))
        exit(json_encode(array('code'=>-1,'message'=>'原密码错误')));
    $msg = array();
    $msg['code'] = $db->update('user',array('password'=>md5($_POST['password'])))?1:0;
    $msg['message'] = $msg['code']==1?'修改密码成功':'修改密码失败';
    echo json_encode($msg);
    exit();
}
?>
<?php include 'blocks/header.php'?>
<div class="ui main container">
    <h1 class="ui header">修改密码</h1>
    <div class="ui divider"></div>
    <div class="ui four column grid">
        <div class="two column row">
            <div class="column">
                <form class="ui form" method="post">
                    <div class="field">
                        <label for="oldPwd">原密码</label>
                        <input type="password" name="oldPwd" id="oldPwd" required>
                    </div>
                    <div class="field">
                        <label for="password">新密码</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field">
                        <label for="rePwd">重复密码</label>
                        <input type="password" name="rePwd" id="rePwd" required>
                    </div>
                    <button class="ui button large" type="submit">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$('.ui.form').submit(function () {
    var opt = {
        tips: [1, 'tomato'],
        time: 4000
    };
    if ($('#password').val()!=$('#rePwd').val())
        layer.tips('输入的两次密码不一致','label[for=rePwd]',opt);
    $.post(location.href,$(this).serialize(),function (d) {
        d = JSON.parse(d);
        if (d.code==1) location.href = 'logout.php';
        else if (d.code==-1) layer.tips(d.message,'label[for=oldPwd]',opt);
        else layer.msg(d.message);
    });
    return false;
})
</script>