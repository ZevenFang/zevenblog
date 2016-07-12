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
    switch ($_POST['act']){
        case 'new':
            $db->where ("name", $_POST['text']);
            $cate = $db->getOne("category");
            $msg = array('code'=>1);
            if ($cate){
                $msg['code'] = -1;
                $msg['message'] = '分类名称已经存在';
            } else {
                $data = array(
                    'name' => $_POST['text'],
                    'create_time' => time(),
                    'user_id' => $_SESSION['user']['id']
                );
                $db->insert('category', $data);
                $msg['message'] = '新建分类成功';
            }
            echo json_encode($msg);
            break;
        case 'edit':
            $db->where("name", $_POST['text']);
            $cate = $db->getOne("category");
            $msg = array('code'=>1);
            if ($cate){
                $msg['code'] = -1;
                $msg['message'] = '分类名称已经存在';
            } else {
                $db->where('id', $_POST['id']);
                $db->update('category',array('name'=>$_POST['text']));
                $msg['message'] = '修改分类成功';
            }
            echo json_encode($msg);
            break;
        case 'del':
            $db->where('id', $_POST['id']);
            $msg = array();
            $msg['code'] = $db->delete('category')?1:-1;
            $msg['message'] = $msg['code']==1?'删除成功':'删除失败，请先删除该分类下的文章';
            echo json_encode($msg);
            break;
    }
    exit();
}
$cates = $db->get('category');