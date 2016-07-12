<?php include "blocks/header.php";?>
<?php
if (!isset($_GET['id'])){
    header('location:index.php');
    exit();
}
$db->where('category_id',$_GET['id']);
$db->orderBy('create_time','desc');
$articles = $db->get('article');
?>
<div class="ui main text container">
    <div class="ui cards">
        <?php if (!$articles){?>
        <div class="card">
            <div class="content">
                <a class="header" href="#">该分类暂时没有数据哟~</a>
            </div>
        </div>
        <?php }?>
        <?php foreach ($articles as $v){?>
            <div class="card">
                <div class="content">
                    <a class="header" href="article.php?id=<?php echo $v['id']?>"><?php echo $v['title']?></a>
                    <div class="meta"><?php echo $catesMap[$v['category_id']]?></div>
                </div>
                <div class="extra content">
                    <a><i class="calendar icon"></i> <?php date_default_timezone_set('PRC');echo date('Y-m-d H:i:s',$v['create_time'])?> </a>
                </div>
            </div>
        <?php }?>
    </div>
</div>
