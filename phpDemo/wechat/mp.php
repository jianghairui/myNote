<?php
/**
 * Created by PhpStorm.
 * User: Jiang
 * Date: 2019/12/27
 * Time: 11:46
 */

//小程序验证文本内容是否违规
function test() {
    $uid = 1;
    $app = Factory::payment($this->mp_config);
    $access_token = $app->access_token;
    $token = $access_token->getToken();
    try {
        $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=' . $token['access_token'];
        $data = [
            'scene' => $uid,
//                'page' => 'pages/index/index',
            'width' => '800'
        ];
        $codeinfo = curl_post_data($url, json_encode($data));
        if(is_null(json_decode($codeinfo,true))){
            $jpg = $codeinfo;//得到post过来的二进制原始数据
            $file = fopen("shareqrcode/".$uid.".jpg","w");//创建件准备写入，文件名xcxcode/wxcode1.jpg为自定义
            fwrite($file,$jpg);//写入
            fclose($file);//关闭
        }else{
            //是json数据
            $codeinfo = json_decode($codeinfo,true);

            $this->weixinlog($this->cmd,var_export($codeinfo,true));
            return ajax($codeinfo,-1);
        }
    } catch (\Exception $e) {
        return ajax($e->getMessage(),-1);
    }

    return ajax();
}