<?php
header('Content-Type:text/html;charset=utf-8');

function M($name) {
	static $model = array();
    if (empty($model[$name])) {
		include './model/model.class.php';
        $model[$name] = new Model($name);
    }
    return $model[$name];
}

class Database{

	public function __construct() {

	}

	public function index() {
		$result = M('student')->getList();
		echo '<pre>';
		print_r($result);
		echo '</pre>';
	}
}

$User = new Database();
$User->index();
?>