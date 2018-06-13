<?php
class Openssl {
//值得注意的是，如果选择密钥是1024bit长的（openssl genrsa -out rsa_private_key.pem 1024），那么支持加密的明文长度字节最多只能是1024/8=128byte
//如果加密的padding填充方式选择的是OPENSSL_PKCS1_PADDING（这个要占用11个字节），那么明文长度最多只能就是128-11=117字节。
//如果超出，那么这些openssl加解密函数会返回false
    CONST DELEN = '256'; //取决于rsa密钥的长度，1024位密钥应设置为128 117
    CONST ENLEN = '245';
    CONST KEY = 'yan';//用于签名加盐，通常在sdk中使用accessKey代替
    CONST PUB = '-----BEGIN PUBLIC KEY-----

-----END PUBLIC KEY-----';
    CONST PRI = '-----BEGIN RSA PRIVATE KEY-----

-----END RSA PRIVATE KEY-----';

    private $config = [
        'private_key_bits' => 1024,
    ];

    public function makeKey(){
        $resource = openssl_pkey_new($this->config);
        openssl_pkey_export($resource, $privateKey);
        echo $privateKey;
        echo openssl_pkey_get_details($resource)['key'];
    }

    //公钥加密
    public static function PublicEncrypt($data){
        $str = '';
        foreach (str_split($data, self::ENLEN) as $chunk) {
            openssl_public_encrypt($chunk, $encryptData, self::PUB);
            $str .= $encryptData;
        }
        return base64_encode($str);
    }

    //公钥解密
    public static function PublicDecrypt($data){
        $data = base64_decode($data);
        $str = '';
        foreach (str_split($data, self::DELEN) as $chunk) {
                openssl_public_decrypt($chunk, $encryptData, self::PUB);
        $str .= $encryptData;
        }
        return $str;
    }

    //私钥加密
    public static function PrivateEncrypt($data)
    {
        $str = '';
        foreach (str_split($data, self::ENLEN) as $chunk) {
            openssl_private_encrypt($chunk, $decryptData, self::PRI);
            $str .= $decryptData;
        }
        return base64_encode($str);
    }

    //私钥解密
    public static function PrivateDecrypt($data)
    {
        $data = base64_decode($data);
        $str = '';
        foreach (str_split($data, self::DELEN) as $chunk) {
            openssl_private_decrypt($chunk, $decryptData, self::PRI);
            $str .= $decryptData;
        }
        return $str;

    }

    //私钥加签
    public static function PrivateSign($data){
        openssl_sign($data, $sign, self::PRI, OPENSSL_ALGO_SHA1);
        return base64_encode($sign);
    }

    /**
     * 私钥验签
     * @param $str 被加密的原始数据
     * @param $sign 签名
     * @return mixed 结果
     */

    public static function PrivateVerify($str, $sign){
        openssl_verify($str, $sign, self::PRI, OPENSSL_ALGO_SHA1);
        return $sign;
    }

    //公钥验签
    public static function PublicVerify($str, $sign){
        $sign = base64_decode($sign);
        $res = openssl_verify($str, $sign, self::PUB, OPENSSL_ALGO_SHA1);
        return $res;
    }


}
?>