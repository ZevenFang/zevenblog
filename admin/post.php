<?php include 'controller/article.php'?>
<?php include 'blocks/header_editor.php'?>
<?php
if (isset($_GET['id'])){
    $db->where('id',$_GET['id']);
    $art = $db->getOne('article');
}
?>
<style>
    .ui.form .field>label{
        font-size: medium;
        font-weight: normal;
    }
</style>
<div class="ui main container">
    <h1 class="ui header"><?php echo isset($_GET['id'])?'修改':'新建'; ?>文章</h1>
    <div class="ui divider"></div>
    <div class="ui four column grid">
        <div class="two column row">
            <div class="column">
                <form class="ui form" method="post">
                    <div class="field">
                        <label for="category_id">分类</label>
                        <select id="category_id" class="ui search dropdown" name="category_id">
                            <?php foreach ($cates as $v) {?>
                                <option value="">请选择分类</option>
                                <option <?php if (isset($art['category_id'])&&$art['category_id']==$v['id']) echo 'selected' ?> value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="field">
                        <label for="title">标题</label>
                        <input type="text" name="title" id="title" value="<?php if (isset($art['title'])) echo $art['title'] ?>">
                    </div>
                    <div class="field">
                        <label for="content">内容</label>
                        <textarea name="content" id="content" style="width: 780px;min-height: 300px"><?php if (isset($art['content'])) echo $art['content'] ?></textarea>
                    </div>
                    <button class="ui button large" type="submit">发布</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('select.dropdown').dropdown();
    var um = UM.getEditor('content');
    $('.ui.form').submit(function () {
        var cid = $('#category_id').val();
        var title = $('#title').val();
        var content = um.getContentTxt();
        var opt = {
            tips: [1, 'tomato'],
            time: 4000
        };
        if (!cid||cid.length==0) layer.tips('请选择分类','label[for=category_id]',opt);
        else if (title.length==0) layer.tips('请填写标题','label[for=title]',opt);
        else if (content.length==0) layer.tips('请填写内容','label[for=content]',opt);
        else{
            var data = {};
            data['category_id'] = cid;
            data['title'] = title;
            data['content'] = um.getContent();
            $.post(location.href,data,function (d) {
                d = JSON.parse(d);
                if (d.code==1) location.href = 'allPosts.php';
                else layer.msg(d.message);
            })
        }
        return false;
    })
</script>
