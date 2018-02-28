<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/2/28
 * Time: 13:15
 */
class CustomCookie {
    static private $_instance=null;
    private $expire=0;
    private $path='';
    private $domain='';
    private $secure=false;
    private $httponly=false;

    /**
     * CustomCookie constructor.
     * @param array $options Cookie相关选项
     */
    private function __construct(array $options=[]) {
        $this->setOptions($options);
    }

    /**
     * @param array $options 设置相关选项
     */
    private function setOptions(array $options=[]) {
        if(isset($options['expire'])) {
            $this->expire = (int)$options['expire'];
        }
        if(isset($options['path'])) {
            $this->path = (string)$options['path'];
        }
        if(isset($options['domain'])) {
            $this->domain = (string)$options['domain'];
        }
        if(isset($options['secure'])) {
            $this->secure = (bool)$options['secure'];
        }
        if(isset($options['httponly'])) {
            $this->httponly = (bool)$options['httponly'];
        }
    }

    /**
     * 设置Cookie
     * @param string $name
     * @param mixed $value
     * @param array $options
     */
    public function set($name,$value,array $options=[]) {
        if(is_array($options) && count($options) > 0) {
            $this->setOptions($options);
        }
        if(is_array($value) || is_object($value)) {
            $value = json_encode($value,JSON_FORCE_OBJECT);
        }
        setcookie($name,$value,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function get($name) {
        if(isset($_COOKIE[$name])) {
            return substr($_COOKIE[$name],0,1) == '{' ? json_decode($_COOKIE[$name]) : $_COOKIE[$name];
        }else {
            return null;
        }
    }

    public function delete($name,array $options=[]) {
        if(is_array($options) && count($options) > 0) {
            $this->setOptions($options);
        }
        if(isset($_COOKIE[$name])) {
            setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
            unset($_COOKIE[$name]);
        }
    }

    public function deleteAll(array $options=[]) {
        if(is_array($options) && count($options) > 0) {
            $this->setOptions($options);
        }
        if(!empty($_COOKIE)) {
            foreach ($_COOKIE as $name=>$value) {
                setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
                unset($_COOKIE[$name]);
            }
        }
    }

    /**
     * 单例模式
     * @param array $options Cookie相关选项
     * @return object
     */
    public static function getInstance(array $options=[]) {
        if(is_null(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class($options);
        }
        return self::$_instance;
    }
}

include "./db.php";
$cookie = CustomCookie::getInstance();
$options = array(
    'expire' => time()+3600*72,
    'path' => '/',
    'domain' => ''
);
//$cookie->set('love','lvvv',$options);
//$cookie->set('story','tylor',$options);
$cookie->deleteAll($options);