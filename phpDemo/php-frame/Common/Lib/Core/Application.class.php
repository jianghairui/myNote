<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/23
 * Time: 17:49
 */
final class Application
{
    static public function run() {
        self::_init();
        self::_seturl();
        spl_autoload_register(array(self ,'_autoload'));
        self::_create_demo();
        self::_app_run();

    }

    static private function _app_run() {
        $controller = isset($_GET[C('VAR_CONTROLLER')]) ? $_GET[C('VAR_CONTROLLER')] : 'Index';
        define('CONTROLLER_NAME',$controller);

        $action = isset($_GET[C('VAR_ACTION')]) ? $_GET[C('VAR_ACTION')] : 'index';
        $controller.= 'Controller';

        $class = APP_NAME . '\\controller\\' .$controller;
        $obj = new $class;
        $obj->$action();

    }

    static private function _autoload($className) {
        include dirname(COMMON_PATH) . '/App/' . str_replace('\\','/',$className) . '.class.php';
    }

    static private function _create_demo() {
        $indexPath = APP_CONTROLLER_PATH . '/IndexController.class.php';
        $app_name = APP_NAME;
        $str = <<<str
<?php
namespace $app_name\controller;
use Core\Controller;
class IndexController extends Controller {

    public function index() {
        echo '<pre>';
        echo "

         |\ .             . /|
        ._\\/             \//_.
          ',\_,         ,_/,'
            \.'         './
            _\\/       \//_
            '-.\,     ,/.-'
               \\     //
              _.-`\"\"\"`-._
           ,-'-' _   _ '-'-,
            '--\ o   o /'-'
               |       |
               |       |
               /       \
               |  \_/  |
                \ _|_ /
                 '---'
        ";
        echo '</pre>';
    }

}
?>
str;
        is_file($indexPath) || file_put_contents($indexPath ,$str);
    }

    static private function _init() {
        C(include(CONFIG_PATH . '/config.php'));
        $ucpath = APP_CONFIG_PATH . '/config.php';
        $userConfig = <<<str
<?php
return array(
    //配置项 =>配置值

);
?>
str;
        is_file($ucpath) || file_put_contents($ucpath ,$userConfig);
        C(include($ucpath));

        date_default_timezone_set(C('DEFAULT_TIME_ZONE'));
        C('SESSION_AUTO_START') && session_start();

    }

    static private function _seturl() {

        $path = 'http:/' . $_SERVER['HOST'] . $_SERVER['SCRIPT_NAME'];
        define('__APP__',$path);
        define('__ROOT__',dirname($path));

    }
}