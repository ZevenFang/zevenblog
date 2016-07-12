<?php include 'controller/article.php'?>
<?php include 'blocks/header.php'?>
<?php
$catesMap = array();
foreach ($cates as $v)
    $catesMap[$v['id']] = $v['name'];
$articles = $db->get('article');
?>
<div class="ui main container">
    <h1 class="ui header">文章管理</h1>
    <div class="ui divider"></div>
    <?php if(empty($articles)){ ?>
    <div class="ui info message">暂时没有文章，点击<a id="new" style="font-weight: bold" href="post.php">创建</a>一个？</div>
    <?php exit();} ?>
    <table class="ui celled table">
        <thead>
        <tr>
            <th>序号</th>
            <th>标题</th>
            <th>分类</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $k => $v){?>
            <tr>
                <td>
                    <div class="ui ribbon label"><?php echo $k+1?></div>
                </td>
                <td><?php echo $v['title']?></td>
                <td><?php echo $catesMap[$v['category_id']]?></td>
                <td><?php date_default_timezone_set('PRC'); echo date('Y-m-d H:i:s',$v['create_time'])?></td>
                <td data-id="<?php echo $v['id']?>" data-name="<?php echo $v['title']?>">
                    <div class="ui small basic icon buttons">
                        <button class="ui button" name="edit"><i class="write icon"></i></button>
                        <button class="ui button" name="del"><i class="trash icon"></i></button>
                    </div>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<script>
    $('button[name=edit]').click(function () {
        var p = $(this).parent().parent();
        var id = p.data('id');
        location.href = 'post.php?id='+id;
    });
    $('button[name=del]').click(function () {
        var p = $(this).parent().parent();
        var id = p.data('id');
        var name = p.data('name');
        layer.confirm('确认删除文章：'+name, {icon: 3, title:'提示'}, function(){
            $.post(location.href,{act:'del',id:id},function (d) {
                d = JSON.parse(d);
                if (d.code==1) location.reload();
                else
                    layer.msg(d.message);
            })
        });
    })
</script>