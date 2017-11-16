<?php
namespace Home\controller;
use Core\Controller;
class IndexController extends Controller {

    public function index() {
        echo '<pre>';
        echo "
         |\ .             . /|
        ._\/             \//_.
          ',\_,         ,_/,'
            \.'         './
            _\/       \//_
            '-.\,     ,/.-'
               \     //
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
        echo '<h2>欢迎使用OH My Deer框架!</h2>';
        p($_SERVER);

//        $this->id = 1;
//        $this->name = '姜海蕤';
//        $this->age = 26;
//        $this->gendar = 'Mail';
//        $this->edu = 'College';
//        $this->desc = 'Dropped Out';
//        $this->template('main');
    }

}
?>