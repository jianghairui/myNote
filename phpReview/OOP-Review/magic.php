<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/10
 * Time: 15:43
 */
//私有属性赋值,魔术方法__set 和 __get
class Example
{
    private $name = 'JiangHaiRui';
    private $sex = 'Male';
//设置私有属性
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
//获取私有属性
    public function __get($name)
    {
        return $this->$name;
    }
//判断私有属性是否存在
    public function __isset($name)
    {
        return isset($this->$name) ? true : false;
    }
//删除私有属性
    public function __unset($name)
    {
        unset($this->$name);
    }
//方法不存在时自动调用__call,私有方法外部调用时,也会调用
    public function __call($name, $arguments)
    {
        $param = implode('\',\'',$arguments);
        echo $name.'(\''.$param.'\')方法不存在!';
    }
//静态方法不存在时调用
    static public function __callStatic($name, $arguments)
    {
        $param = implode('\',\'',$arguments);
        echo $name.'(\''.$param.'\')的静态方法不存在!';
    }

    public function run($name,$age) {
        echo $name.'今年'.$age.'岁了';
    }
//对象当做函数调用时
    public function __invoke($args)
    {
        echo '对象当做函数调用时,输出我的名字'.$this->name;
    }
//打印对象时自动调用
    public function __toString() {
        return 'echo($obj)时自动调用';
    }

}

$obj = new Example();
//$obj->name = 'Jiang';
//unset($obj->name);
//var_dump($obj);
//var_dump(isset($obj->sex));

//$obj->run('xiaoming',1);
//$obj::say('nimabi');
//var_dump($obj);
//$obj(array('a','b','c'));
//echo $obj;
