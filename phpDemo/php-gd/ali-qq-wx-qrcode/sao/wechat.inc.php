<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>微信钱包支付</title>
    <link rel="stylesheet" href="./layui/css/layui.css">
</head>
<body>

<!-- 你的HTML代码 -->
<fieldset class="layui-elem-field" style="text-align: center;margin: 20px;padding: 5px">
    <legend>扫码向“<?php echo $nick;?>”付款</legend>
    <div class="layui-field-box" style="text-align: center">
        <img style="width: 100%;" src="data:image/png;base64,<?php echo $base64;?>">
        <div style="margin-top: 10px;font-size: 12px;"></div>
        请长按识别上方二维码向我转账
    </div>
</fieldset>
</body>
</html>