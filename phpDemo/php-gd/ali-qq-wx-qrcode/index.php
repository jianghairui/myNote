<?php include 'database.php'?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>三网收款码整合系统 - QQ钱包/支付宝/微信钱包二维码整合工具</title>
    <link rel="stylesheet" href="./layui/css/layui.css">
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header" style="white-space: nowrap;">
        <div class="layui-logo">温泉二维码整合系统</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item layui-this"><a href="">合并</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">更多</a>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <?php echo $runtime['nav']?>
                </dl>
            </li>

        </ul>
    </div>
</div>
        <div style="padding: 15px;">

            <fieldset class="layui-elem-field">
                <legend>上传您的收款码</legend>
                <div class="layui-field-box">
                    <div class="layui-row layui-col-space10">
                        <div class="layui-col-md3">
                            <div class="layui-upload-drag" id="alipay" style="background-image: url();background-position: center center;background-repeat: no-repeat;background-size: contain;width: 80%;height: 250px">
                                <i class="layui-icon"></i>
                                <p>支付宝</p>
                                <p>点击上传，或将文件拖拽到此处</p>
                            </div>
                        </div>
                        <div class="layui-col-md3">
                            <div class="layui-upload-drag" id="alired" style="background-image: url();background-position: center center;background-repeat: no-repeat;background-size: contain;width: 80%;height: 250px">
                                <i class="layui-icon"></i>
                                <p>支付宝赏金红包</p>
                                <p>点击上传，或将文件拖拽到此处</p>
                            </div>
                        </div><div class="layui-col-md3">
                            <div class="layui-upload-drag" id="qqpay" style="background-image: url();background-position: center center;background-repeat: no-repeat;background-size: contain;width: 80%;height: 250px">
                                <i class="layui-icon"></i>
                                <p>QQ钱包</p>
                                <p>点击上传，或将文件拖拽到此处</p>
                            </div>
                        </div>
                        <div class="layui-col-md3">
                            <div class="layui-upload-drag" id="wxpay" style="background-image: url();background-position: center center;background-repeat: no-repeat;background-size: contain;width: 80%;height: 250px">
                                <i class="layui-icon"></i>
                                <p>微信钱包</p>
                                <p>点击上传，或将文件拖拽到此处</p>
                            </div>
                        </div>


                    </div>

                    <form style="padding: 5px;" class="layui-form">
                        <hr class="layui-bg-blue" style="margin-top: 20px;">
                        <input type="text" style="width: 100%;margin-top: 20px;border-radius: 50px;text-align: center;" name="alipay" placeholder="支付宝解析结果" autocomplete="off" class="layui-input layui-disabled" readonly="readonly">
                        <input type="text" style="width: 100%;margin-top: 20px;border-radius: 50px;text-align: center;" name="alired" placeholder="支付宝赏金红包解析结果" autocomplete="off" class="layui-input layui-disabled" readonly="readonly">
                        <input type="text" style="width: 100%;margin-top: 20px;border-radius: 50px;text-align: center;" name="qqpay" placeholder="QQ钱包解析结果" autocomplete="off" class="layui-input layui-disabled" readonly="readonly">
                        <input type="text" style="width: 100%;margin-top: 20px;border-radius: 50px;text-align: center;" name="wxpay" placeholder="微信钱包解析结果" autocomplete="off" class="layui-input layui-disabled" readonly="readonly">
                       <input type="text" style="width: 100%;margin-top: 20px;border-radius: 50px;text-align: center;" name="nick" placeholder="请输入收款人名称" autocomplete="off" class="layui-input">
                        <div class="layui-form-item" style="width: 100%;margin-top: 20px;">
                            <label class="layui-form-label">请选择样式</label>
                            <div class="layui-input-block">
                                <input type="radio" name="template" value="0" title="纯二维码" checked>
                                <?php
                                for ($i =1 ; $i<=18 ; $i++){
                                    echo '                                <input type="radio" name="template" value="'.$i.'" title="模板'.$i.'">
';
                                }
                                ?>
                                </div>
                        </div>
                        <?php if (!empty($config['verification']['vid'])){
                            echo '                        <div id="vaptchaContainer" style="width: 100%;height: 36px;">
                            <div class="vaptcha-init-main">
                                <div class="vaptcha-init-loading">
                                    <a href="/" target="_blank">
                                        <img src="https://cdn.vaptcha.com/vaptcha-loading.gif" />
                                    </a>
                                    <span class="vaptcha-text">Vaptcha启动中...</span>
                                </div>
                            </div>
                        </div>';}?>
                        <button class="layui-btn layui-btn-normal layui-btn-radius" style="width: 100%;margin-top: 20px" lay-submit lay-filter="formDemo">一键合并收款码</button>
                    </form>
                </div>
            </fieldset>
            <fieldset class="layui-elem-field">
                <legend>常见问题</legend>
                <div class="layui-field-box">
                    <?php echo $config['website']['question']?>
                </div>
            </fieldset>
            <div style="text-align: center;padding-top: 20px;">
                <?php echo $config['website']['footer']?>
            </div>
        </div>




<script src="./layui/layui.js"></script>
<?php if (!empty($config['verification']['vid'])){
    echo '<script src="https://cdn.vaptcha.com/v2.js"></script>';
}?>

<script>
    //JavaScript代码区域
    <?php if (!empty($config['verification']['vid'])){
        echo '    vaptcha({
        //配置参数
        vid: \''.$config['verification']['vid'].'\',
        type: \'click\',
        container: \'#vaptchaContainer\' 
    }).then(function (vaptchaObj) {
        vaptchaObj.render()
        window.vaptchaObj = vaptchaObj;
    });';
    }?>


    layui.use(['jquery','element','form', 'upload','layer'], function(){
        var element = layui.element;
        var form = layui.form;
        var upload = layui.upload;
        var $ = layui.jquery;
        var layer =layui.layer;
        //监听提交
        form.on('submit(formDemo)', function(data){
            <?php if (!empty($config['verification']['vid'])){
            echo '            data.field.token =  vaptchaObj.getToken();
            vaptchaObj.reset();';
        }?>

            layer.msg("正在制作中", {icon: 16, shade: 0.06,time:0});
            //layer.msg(JSON.stringify(data.field));
            $.ajax({
                type : "POST",
                url : "ajax.php?mod=payqr",
                data : "c="+encodeURIComponent(JSON.stringify(data.field)),
                dataType : 'json',
                success : function(data) {
                    layer.closeAll();
                    if(data.code < 0){
                        layer.alert(data.msg, {icon: 5});
                    }else {
                        layer.alert('<img style="max-height: 430px; max-width: 320px" src="data:image/png;base64,' + data.pic + '">',{shadeClose:true,title:'请右键保存或长按另存为'});
                    }
                },
                error:function(data){
                    layer.closeAll();
                    layer.alert('服务器错误');
                }
            });
            return false;
        });
        upload.render({
            elem: '#alipay',
            url: 'ajax.php?mod=QrDecode&c=alipay',
            accept: 'images',
            acceptMime: 'image/*',
            size:350,
            before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.msg("正在上传二维码并解析", {icon: 16, shade: 0.06, time:0});
                obj.preview(function(index, file, result){
                    $("#alipay").css("background-image","url("+result+")");
                });
            },
            done: function(res){
                layer.closeAll();
                if(res.code < 0){
                    $("#alipay").css("background-image","url()");
                    return layer.msg(res.msg, {icon: 5});
                }
                layer.msg('二维码解析成功', {icon: 6});
                $("input[name='alipay']").val(res.result)
            },
            error: function(){
                layer.closeAll();
                layer.msg('文件上传请求失败', {icon: 5});
                $("#alipay").css("background-image","url()");
            }
        });
        upload.render({
            elem: '#alired',
            url: 'ajax.php?mod=QrDecode&c=alired',
            accept: 'images',
            acceptMime: 'image/*',
            size:350,
            before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.msg("正在上传二维码并解析", {icon: 16, shade: 0.06, time:0});
                obj.preview(function(index, file, result){
                    $("#alired").css("background-image","url("+result+")");
                });
            },
            done: function(res){
                layer.closeAll();
                if(res.code < 0){
                    $("#alired").css("background-image","url()");
                    return layer.msg(res.msg, {icon: 5});
                }
                layer.msg('二维码解析成功', {icon: 6});
                $("input[name='alired']").val(res.result)
            },
            error: function(){
                layer.closeAll();
                layer.msg('文件上传请求失败', {icon: 5});
                $("#alired").css("background-image","url()");

            }
        });
        upload.render({
            elem: '#qqpay',
            url: 'ajax.php?mod=QrDecode&c=qqpay',
            accept: 'images',
            acceptMime: 'image/*',
            size:350,
            before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.msg("正在上传二维码并解析", {icon: 16, shade: 0.06, time:0});
                obj.preview(function(index, file, result){
                    $("#qqpay").css("background-image","url("+result+")");
                });
            },
            done: function(res){
                layer.closeAll();
                if(res.code < 0){
                    $("#qqpay").css("background-image","url()");
                    return layer.msg(res.msg, {icon: 5});
                }
                layer.msg('二维码解析成功', {icon: 6});
                $("input[name='qqpay']").val(res.result)
            },
            error: function(){
                layer.closeAll();
                layer.msg('文件上传请求失败', {icon: 5});
                $("#qqpay").css("background-image","url()");

            }
        });
        upload.render({
            elem: '#wxpay',
            url: 'ajax.php?mod=QrDecode&c=wxpay',
            accept: 'images',
            acceptMime: 'image/*',
            size:350,
            before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.msg("正在上传二维码并解析", {icon: 16, shade: 0.06, time:0});
                obj.preview(function(index, file, result){
                    $("#wxpay").css("background-image","url("+result+")");
                });
            },
            done: function(res){
                layer.closeAll();
                if(res.code < 0){
                    $("#wxpay").css("background-image","url()");
                    return layer.msg(res.msg, {icon: 5});
                }
                layer.msg('二维码解析成功', {icon: 6});
                $("input[name='wxpay']").val(res.result)
            },
            error: function(){
                layer.closeAll();
                layer.msg('文件上传请求失败', {icon: 5});
                $("#wxpay").css("background-image","url()");

            }
        });

    });

</script>

</body>
</html