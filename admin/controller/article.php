<?php
$conf = require '../conf/config.php';
require '../libs/MysqliDb.php';
$db = new MysqliDb($conf);
if (!empty($_POST)){
    session_start();
    if (!isset($_SESSION['user'])){
        header('HTTP/1.1 401 Unauthorized');
        header('status: 401 Unauthorized');
        exit();
    }
    if (isset($_POST['act'])&&$_POST['act']=='del'){
        $db->where('id', $_POST['id']);
        $msg = array();
        $msg['code'] = $db->delete('article')?1:-1;
        $msg['message'] = $msg['code']==1?'删除成功':'删除失败';
        echo json_encode($msg);
    } else {
        $data = $_POST;
        $data['user_id'] = $_SESSION['user']['id'];
        $data['create_time'] = time();
        $msg = array();
        if (isset($_GET['id'])){
            $db->where('id',$_GET['id']);
            $msg['code'] = $db->update('article',$data)?1:0;
            $msg['message'] = $msg['code'] == 1 ? '修改文章成功' : '修改文章失败';
        } else {
            $msg['code'] = $db->insert('article', $data) ? 1 : 0;
            $msg['message'] = $msg['code'] == 1 ? '新建文章成功' : '新建文章失败';
        }
        echo json_encode($msg);
    }
    exit();
}
$cates = $db->get('category');
