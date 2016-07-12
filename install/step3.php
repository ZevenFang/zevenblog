<?php include 'header.php'?>
<?php $ins->update_config(array('installed'=>true));?>
<div class="ui main container">
    <div class="ui ordered steps">
        <div class="completed step">
            <div class="content">
                <div class="title">设置数据库</div>
                <div class="description">设置数据库账户和密码</div>
            </div>
        </div>
        <div class="completed step">
            <div class="content">
                <div class="title">设置管理员</div>
                <div class="description">设置管理员账户和密码</div>
            </div>
        </div>
        <div class="completed step">
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
                <div class="ui info message">系统安装完成，点击<a id="new" style="font-weight: bold" href="../admin/index.php">登陆</a>后台？</div>
            </div>
        </div>
    </div>
</div>