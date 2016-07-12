<?php include 'blocks/header.php' ?>
<?php $user = $_SESSION['user'] ?>
<div class="ui main container">
    <h1 class="ui header">控制台</h1>
    <div class="ui divider"></div>
    <p>欢迎您，<?php echo $user['nickname']?></p>
    <p>您上次登陆ip为：<?php echo $user['ip']?></p>
    <p>您上次登录时间为：<?php date_default_timezone_set('PRC'); echo date('Y-m-d H:i:s',$user['login_time'])?></p>
</div>
