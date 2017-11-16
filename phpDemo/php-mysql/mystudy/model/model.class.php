<?php
include '/conf/config.php';

class Model {

	public function __construct($tablename = '') {
		$this->tablename = $tablename;
	}

	public function getList() {
		$sql = "SELECT * FROM ".$this->tablename;
		$resource = mysql_query($sql) or die(mysql_error());
		$arr = array();
		while($row = mysql_fetch_assoc($resource)) {
			$arr[] = $row;
		}
		return $arr;
	}

}

?>