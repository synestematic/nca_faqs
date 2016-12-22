<?php
class Branch {

	public $id;
	public $lc_id;
	public $lc_associato;
	public $filiale;
	public $nb_number;
	public $field;

	private static function instantiate($result) {
		$object = new self;
		isset($result["id"]) ? $object->id = $result["id"] : false ;

		if (isset($result["lc_id"])) {
			$object->lc_id = $result["lc_id"];
			$lc = Lc::find_by_id($object->lc_id);
      $object->lc_associato = $lc->centro;
		}

		isset($result["filiale"]) ? $object->filiale = $result["filiale"] : false ;
		isset($result["nb_number"]) ? $object->nb_number = $result["nb_number"] : false ;
		isset($result["Field"]) ? $object->field = $result["Field"] : false ;
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
		return self::find_by_sql("SELECT * FROM branches");
	}

	public static function find_by_id($id=1) {
		global $nca_db;
		$sql = 'SELECT * FROM branches WHERE id = "';
		$sql .= $nca_db->escape_string($id);
		$sql .= '" LIMIT 1';
		$result = self::find_by_sql($sql);
		return !empty($result) ? array_shift($result) : false ;
	}

	public static function find_by_filiale($filiale='') {
		global $nca_db;
		$sql = 'SELECT * FROM branches WHERE filiale = "';
		$sql .= $nca_db->escape_string($filiale);
		$sql .= '" LIMIT 1';
		$result = self::find_by_sql($sql);
		return !empty($result) ? array_shift($result) : false ;
	}

	public static function enumerate_branches() {
		return self::find_by_sql("SELECT DISTINCT `filiale` FROM branches WHERE filiale != 'Milano HQ'");
	}

	public static function branches_menu($name) {
		global $_POST;
		echo '<select style="width:50%" name="'.$name.'">';
		echo "<option>";
		echo "";
		echo "</option>";
		$branches = self::enumerate_branches();
		foreach ($branches as $branch) {
			echo ($branch->filiale == $_POST["branch_origine"]) ? '<option selected>' : '<option>' ;
			echo $branch->filiale;
			echo "</option>";
		}
		echo "</select>";
	}

}

?>
