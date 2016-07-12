<?php
$conf = require 'conf/config.php';
if (!$conf['installed']){//未安装
    header('location:install/index.php');
    exit();
}
require 'libs/MysqliDb.php';
$db = new MysqliDb ($conf);
$cates = $db->get('category');
$catesMap = array();
foreach ($cates as $v)
    $catesMap[$v['id']] = $v['name'];
?>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="semantic/dist/semantic.min.js"></script>
    <script src="js/layer/layer.js"></script>
    <script src="js/laypage/laypage.js"></script>
    <title><?php echo isset($TITLE)?$TITLE:'ZEVEN博客';?></title>
</head>
<body>
<div class="ui fixed inverted menu">
    <div class="ui container">
        <a href="#" class="header item">
            ZEVEN博客
        </a>
        <a href="index.php" class="item">首页</a>
        <?php if ($cates){?>
        <div class="ui simple dropdown item">
            分类 <i class="dropdown icon"></i>
            <div class="menu">
                <?php foreach ($cates as $v){?>
                <a class="item" href="category.php?id=<?php echo $v['id']?>"><?php echo $v['name']?></a>
                <?php }?>
            </div>
        </div>
        <?php }?>
        <div class="right item">
            <a class="ui inverted button" href="admin/index.php">后台</a>
        </div>
    </div>
</div>