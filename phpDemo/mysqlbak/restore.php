<?php
include './dbconfig.php';
if($_GET['dbversion']) {
    @unlink($_GET['dbversion']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/jquery-2.0.3.min.js"></script>
    <style>
        *{padding:0;margin:0}
        body,html{width: 100%;height: 100%;}
        button{width:50px;height:35px;font-size: 20px}
        tr > td {text-align: center}
    </style>
</head>
<body>
<div style="position: relative;width:100%;height: 100px;">
    <div id="loading" style="margin: auto;width:100px;height: 100px;display: none">
        <img src="loading.gif" style="width:100px" alt="">
    </div>
</div>
<div style="position: relative;width:100%;">
    <div style="position: absolute;width:100%;height: 100%;display: none">

    </div>
    <table style="margin:auto" width="800" border="1">
        <caption></caption>
        <thead>
        <tr>
            <th>数据库版本名称</th>
            <th>备份时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($_GET['dbname']) {
            $path = $_GET['dbname'];
            $arr = recurDir($path);
            foreach ($arr as $k=>$v) {
                echo '<tr><td>'.str_replace($path . '/','',$v).'</td><td>'.date('Y年m月d日 H:i:s',filemtime($v)).'</td><td><a href="'.$v.'"><button>下载</button></a>&nbsp;&nbsp;&nbsp;<a href="?dbversion='.$v.'&dbname='.$_GET['dbname'].'"><button>删除</button></a>&nbsp;&nbsp;&nbsp;<button onclick="backup(\''.$v.'\')">还原</button></td></tr>';
            }
        }
        ?>
        <tr>
            <td colspan="3">
                <h3><a href="">清除全部数据库</a></h3>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script>

    function backup(dbname) {
        $("#loading").css('display','block')
        $('.button').attr('disabled',true)
        $.ajax({
            url:"./restoreAjax.php",
            dataType:"json",
            type:"post",
            data:{dbname:dbname},

            success:function(res) {
                console.log(res)
                $("#loading").css('display','none')
                $('.button').attr('disabled',false)
                alert(res.msg)
            },
            error:function(res) {
                console.log(res)
                $("#loading").css('display','none')
                $('.button').attr('disabled',false)
                alert('接口请求失败')
            }
        })
    }

</script>
</body>
</html>
