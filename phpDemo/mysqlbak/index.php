<?php
include './dbconfig.php';
$databases = getResult($con,'SHOW DATABASES');
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
        .button{width:150px;height:35px;font-size: 20px}
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
            <th>数据库名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($databases as $v) {
            if(!in_array($v['Database'],array('information_schema','performance_schema'))) {
                echo '<tr><td>'.$v['Database'].'</td><td><button class="button" onclick="backup(\'' .$v['Database']. '\')">备份</button></td></tr>';
            }
        }
        ?>
        <tr>
            <td colspan="2">
                <h3><a href="downloadlist.php">下载历史数据库</a></h3>
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
            url:"./backup.php",
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
