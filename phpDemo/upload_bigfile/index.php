<?php
if (version_compare(phpversion(), '5.4.0', '<'))
    exit('ERROR: Your PHP version is ' . phpversion() . ' but this script requires PHP 5.4.0 or higher.');

if (!intval(ini_get('session.upload_progress.enabled')))
    exit('session.upload_progress.enabled is not enabled, please activate it in your PHP config file to use this script.');
//echo ini_get('session.upload_progress.enabled').'<br>';
//echo ini_get('session.upload_progress.name').'<br>';
//echo ini_get('session.upload_progress.prefix').'<br>';
//die;
require_once ("upload.class.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; }
    </style>
</head>
<body>
<form id="form" action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="<?php echo CUpload::UPLOAD_PROGRESS_PREFIX; ?>" />
    <table>
        <tr>
            <td><input name="file1" type="file" align="right"/></td>
            <td><input id="button" type="button" name="Submit" value="上传"/></td>
        </tr>
    </table>
</form>

<div class="progress">
    <div class="bar"></div >
    <div class="percent">0%</div >
</div>

<script src="js/jquery.js"></script>
<script src="js/jquery.form.js"></script>
<script>
    var bar = $('.bar');
    var percent = $('.percent');
    $("#button").click(function() {
        $("#form").ajaxSubmit({
            dataType:"json",
            beforeSubmit:function(e) {
                setTimeout('fetch_progress()', 2000);
            },
            success:function(e) {
                console.log(e)
            },
            error:function(e) {
                console.log(e)
                alert('请求失败')
            }
        })
    })


    function fetch_progress(){
        $.get('get_progress.php',{}, function(data){
            var progress = parseInt(data);

            bar.width(data+'%')
            $('#progress .percent').html(data+'%');
            if(progress < 100){
                setTimeout('fetch_progress()', 500);    //当上传进度小于100%时，显示上传百分比
            }else{
                $('#progress .percent').html('完成!'); //当上传进度等于100%时，显示上传完成
            }
        }, 'html');
    }

</script>
</body>
</html>