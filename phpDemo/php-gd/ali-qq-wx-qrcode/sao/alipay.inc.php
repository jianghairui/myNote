<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>支付宝支付</title>
    <link rel="stylesheet" href="../layui/css/layui.css">
</head>
<body>

<!-- 你的HTML代码 -->
<fieldset class="layui-elem-field" style="text-align: center;margin: 20px;padding: 5px">
    <legend>正在向“<?php echo $nick;?>”付款</legend>
    <div class="layui-field-box" style="text-align: center">
        <button onclick="turnpage(1)" class="layui-btn layui-btn-normal" style="width: 100%">点击领取支付宝最高99元红包</button>
        领取红包后再次扫描本二维码即可使用<br><br>
        <hr><br>
        如果您已有红包或不想领取红包<button onclick="turnpage(2)" class="layui-btn" style="width: 100%">点击进入转账页面</button>
    </div>
</fieldset>
<script src="./layui/layui.all.js"></script>

<script>
    layui.define(['layer', 'form', 'jquery'], function(exports){
         window.layer = layui.layer;
         window.form = layui.form;
         window.$ = layui.jquery;
    });
    function turnpage(type) {
        if (type===1) {
            layer.msg("请稍后", {icon: 16, shade: 0.06,time:0});
            $.ajax({
                type : "GET",
                url : "ajax.php?mod=redget",
                dataType : 'html',
                success : function(data) {
                    window.location.href='<?php echo $red;?>';
                },
                error:function(data){
                    window.location.href='<?php echo $red;?>';
                }
            });
        }else {
            window.location.href='<?php echo $pay;?>';

        }
    }
</script>
</body>
</html>