<?php
require 'Installer.class.php';
$ins = new Installer();
if ($ins->checkInstalled()){
    header('location:../index.php');
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
    <title><?php echo isset($TITLE)?$TITLE:'ZEVEN博客安装向导';?></title>
</head>
<body>