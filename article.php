<?php include 'blocks/header.php'?>'
<?php
if (!isset($_GET['id'])){
    header('location:index.php');
    exit();
}
$db->where('id',$_GET['id']);
$art = $db->getOne('article');
?>
<div class="ui main text container">
    <h1 class="ui header"><?php echo $art['title']?></h1>
    <div class="ui divider"></div>
    <div><?php echo $art['content']?></div>
    <div class="ui divider"></div>
    <!-- 多说分享 start -->
    <div class="ds-share flat" data-thread-key="64b0834f331bc1ebeb1b8d6eab8b60f9" data-title="<?php echo $art['title']?>" data-images="" data-content='<?php echo $art['content']?>' data-url="">
        <div class="ds-share-aside-right">
            <div class="ds-share-aside-inner"></div>
            <div class="ds-share-aside-toggle">分享到</div>
        </div>
    </div>
    <!-- 多说分享 end -->
    <!-- 多说评论框 start -->
    <div class="ds-thread" data-thread-key="64b0834f331bc1ebeb1b8d6eab8b60f9" data-title="<?php echo $art['title']?>" data-url=""></div>
    <!-- 多说评论框 end -->
    <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
    <script type="text/javascript">
        var duoshuoQuery = {short_name:"hbmblog"};
        var share = $('.ds-share');
        share.attr('data-url',location.href);
        share.hide();
        setTimeout(function () {
            share.show();
        },1500);
        $('.ds-thread').attr('data-url',location.href);
        (function() {
            var ds = document.createElement('script');
            ds.type = 'text/javascript';ds.async = true;
            ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.unstable.js';
            ds.charset = 'UTF-8';
            (document.getElementsByTagName('head')[0]
            || document.getElementsByTagName('body')[0]).appendChild(ds);
        })();
    </script>
    <!-- 多说公共JS代码 end -->
</div>