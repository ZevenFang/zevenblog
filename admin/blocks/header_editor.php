<?php
session_start();
if (!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
}
?>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" type="text/css" href="../semantic/dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/jquery.js"></script>
    <script src="../semantic/dist/semantic.min.js"></script>
    <script src="../js/layer/layer.js"></script>
    <!-- 样式文件 -->
    <link rel="stylesheet" href="./umeditor/themes/default/css/umeditor.css">
    <!-- 配置文件 -->
    <script type="text/javascript" src="./umeditor/umeditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="./umeditor/umeditor.js"></script>
    <!-- 语言包文件 -->
    <script type="text/javascript" src="./umeditor/lang/zh-cn/zh-cn.js"></script>
    <title><?php echo isset($TITLE)?$TITLE:'ZEVEN博客后台管理';?></title>
</head>
<body>
<?php include 'nav.php'?>