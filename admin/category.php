<?php include 'controller/category.php'?>
<?php include 'blocks/header.php'?>
<div class="ui main container">
    <h1 class="ui header">分类管理</h1>
    <div class="ui divider"></div>
    <script>
        $(function () {
            $('#new').click(function () {
                layer.prompt({
                    title: '请输入新分类名称',
                    formType: 0 //prompt风格，支持0-2
                }, function(text){
                    $.post(location.href,{act:'new',text:text},function (d) {
                        d = JSON.parse(d);
                        if (d.code==1) location.reload();
                        else {
                            layer.tips(d.message,'.layui-layer-input', {
                                tips: [1, 'tomato'],
                                time: 4000
                            });
                        }
                    })
                });
            })
        })
    </script>
    <?php if(empty($cates)){ ?>
    <div class="ui info message">暂时没有分类，点击<a id="new" style="font-weight: bold" href="#">创建</a>一个？</div>
    <?php exit();} ?>
    <table class="ui celled table">
        <thead>
        <tr>
            <th>序号</th>
            <th>分类名</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cates as $k => $v){?>
        <tr>
            <td>
                <div class="ui ribbon label"><?php echo $k+1?></div>
            </td>
            <td><?php echo $v['name']?></td>
            <td><?php date_default_timezone_set('PRC'); echo date('Y-m-d H:i:s',$v['create_time'])?></td>
            <td data-id="<?php echo $v['id']?>" data-name="<?php echo $v['name']?>">
                <div class="ui small basic icon buttons">
                    <button class="ui button" name="edit"><i class="write icon"></i></button>
                    <button class="ui button" name="del"><i class="trash icon"></i></button>
                </div>
            </td>
        </tr>
        <?php }?>
        </tbody>
        <tfoot class="full-width">
        <tr>
            <th colspan="5">
                <div class="ui right floated small info labeled icon button" id="new"><i class="tag icon"></i> 添加分类 </div>
            </th>
        </tr>
        </tfoot>
    </table>
</div>
<script>
    $('button[name=edit]').click(function () {
        var p = $(this).parent().parent();
        var id = p.data('id');
        var name = p.data('name');
        layer.prompt({
            title: '请输入新分类名称',
            value:name,
            formType: 0 //prompt风格，支持0-2
        }, function(text){
            $.post(location.href,{act:'edit',id:id,text:text},function (d) {
                d = JSON.parse(d);
                if (d.code==1) location.reload();
                else
                    layer.tips(d.message,'.layui-layer-input', {
                        tips: [1, 'tomato'],
                        time: 4000
                    });
            })
        });
    });
    $('button[name=del]').click(function () {
        var p = $(this).parent().parent();
        var id = p.data('id');
        var name = p.data('name');
        layer.confirm('确认删除分类：'+name, {icon: 3, title:'提示'}, function(){
            $.post(location.href,{act:'del',id:id},function (d) {
                d = JSON.parse(d);
                if (d.code==1) location.reload();
                else
                    layer.msg(d.message);
            })
        });
    })
</script>