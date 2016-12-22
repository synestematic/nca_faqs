<?php
class Lc {

	public $id;
	public $centro;

	private static function instantiate($result) {
		$object = new self;
		isset($result["id"]) ? $object->id = $result["id"] : false ;
		isset($result["centro"]) ? $object->centro = $result["centro"] : false ;
		return $object;
	}

	public static function find_by_sql($sql="") {
		global $nca_db;
		$result_set = $nca_db->query($sql);
		$object_array = array();
		while ($result = mysqli_fetch_assoc($result_set)) {
			$object_array[] = self::instantiate($result);
		}
		return $object_array;
	}

	public static function find_all() {
		return self::find_by_sql("SELECT * FROM lcs");
	}

	public static function find_by_id($id=1) {
		global $nca_db;
		$sql = 'SELECT * FROM lcs WHERE id = "';
		$sql .= $nca_db->escape_string($id);
		$sql .= '" LIMIT 1';
		$result = self::find_by_sql($sql);
		return !empty($result) ? array_shift($result) : false ;
	}

	public static function find_by_centro($centro='') {
		global $nca_db;
		$sql = 'SELECT * FROM lcs WHERE centro = "';
		$sql .= $nca_db->escape_string($centro);
		$sql .= '" LIMIT 1';
		$result = self::find_by_sql($sql);
		return !empty($result) ? array_shift($result) : false ;
	}

}

?>
