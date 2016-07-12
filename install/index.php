<?php include 'header.php'?>
<?php
if (!empty($_POST)){
    require '../libs/MysqliDb.php';
    $conf = $_POST;
    $conf['charset'] = 'utf8';
    $db = new MysqliDb($conf);
    $data = file_get_contents('db.sql');
    $sqls = explode(';',$data);
    array_pop($sqls);
    foreach ($sqls as $sql)
        $db->query($sql);
    $ins->update_config($conf);
    header('location:step2.php');
}
?>
<div class="ui main container">
    <div class="ui ordered steps">
        <div class="active step">
            <div class="content">
                <div class="title">设置数据库</div>
                <div class="description">设置数据库账户和密码</div>
            </div>
        </div>
        <div class="step">
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
                        <label for="host">数据库地址</label>
                        <input type="text" name="host" id="host" value="localhost" required>
                    </div>
                    <div class="field">
                        <label for="username">数据库账户</label>
                        <input type="text" name="username" id="username" placeholder="请确认该账号有创建表权限" required>
                    </div>
                    <div class="field">
                        <label for="password">数据库密码</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="field">
                        <label for="db">数据库名</label>
                        <input type="text" name="db" id="db" value="zevenblog" placeholder="请确认存在此数据库" required>
                    </div>
                    <div class="field">
                        <label for="port">端口号</label>
                        <input type="text" name="port" id="port" value="3306" required>
                    </div>
                    <button class="ui button large" type="submit">提交</button>
                </form>
            </div>
        </div>
    </div>
</div>
