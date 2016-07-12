<?php include 'blocks/header.php'?>
<?php
$db->orderBy('create_time','desc');
$page = isset($_GET['page'])?$_GET['page']:1;
$db->pageLimit = 5;
$articles = $db->arraybuilder()->paginate("article", $page);
$pages = $db->totalPages;
?>
<div class="ui main text container">
    <div class="ui cards">
        <?php if (!$articles){?>
            <div class="card">
                <div class="content">
                    <a class="header" href="#">该博客暂时没有内容哟~</a>
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
    <div class="ui divider"></div>
    <div id="page" style="margin-bottom: 3em"></div>
</div>
<script>
    laypage({
        cont: 'page', //容器。值支持id名、原生dom对象，jquery对象,
        curr: function(){ //通过url获取当前页，也可以同上（pages）方式获取
            var page = location.search.match(/page=(\d+)/);
            return page ? page[1] : 1;
        }(),
        jump: function(e, first){ //触发分页后的回调
            if(!first){ //一定要加此判断，否则初始时会无限刷新
                location.href = '?page='+e.curr;
            }
        },
        pages: <?php echo $pages?>, //总页数
        skin: 'molv', //皮肤
        first: 1, //将首页显示为数字1,。若不显示，设置false即可
        last: 11, //将尾页显示为总页数。若不显示，设置false即可
        prev: '<', //若不显示，设置false即可
        next: '>' //若不显示，设置false即可
    });
</script>