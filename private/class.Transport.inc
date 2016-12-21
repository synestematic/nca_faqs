<?php

class Transport {

	public $from_branch = "";
	public $from_compound = "";
	public $to_compound = "";
	public $to_zip = "";
	public $price = "-";

	private static function instantiate($result) {
		$object = new self;
		isset($result["From compound"]) ? $object->from_compound = $result["From compound"] : false ;

		isset($result["To compound"]) ? $object->to_compound = $result["To compound"] : false ;

		if (isset($result["To zip code region"])) {
			$object->to_zip = sprintf("%02d", $result["To zip code region"]);
		}

		isset($result["Final Invoice rate"]) ? $object->price = $result["Final Invoice rate"] : false ;
		isset($result["New final Invoice rate"]) ? $object->price = $result["New final Invoice rate"] : false ;
		return $object;
	}

	public static function find_by_sql($sql="") {
		global $local_db;
		$result_set = $local_db->query($sql);
		$object_array = array();
		while ($result = mysqli_fetch_assoc($result_set)) {
			$object_array[] = self::instantiate($result);
		}
		return $object_array;
	}

	public static function find_all() {
		return self::find_by_sql("SELECT * FROM c2c_dom");
	}

	public static function check_for_same_lc($origine, $destino) {
		if ($origine == $destino) {
			return new self;
		} else {
			return false;
		}
	}
	public static function check_for_blank($origine, $destino) {
		if ($origine == "" || $destino == "") {
			return new self;
		} else {
			return false;
		}
	}

	public static function lc_to_lc($from="", $to="") {
		$blank = self::check_for_blank($from, $to);
		if (empty($blank)) {
				$check_same_lc = self::check_for_same_lc($from, $to);
				if (empty($check_same_lc)) {
					$sql = "SELECT * FROM c2c_dom WHERE `From compound` = '$from' AND `To compound` = '$to' LIMIT 1";
					$result_array = self::find_by_sql($sql);
					return !empty($result_array) ? array_shift($result_array) : false ;
				} else {
					return $check_same_lc;
				}
			} else { return $blank; }
	}

	public static function lcx_to_lc($lcx, $lc) {
			$blank = self::check_for_blank($lcx, $lc);
 			if (empty($blank)) {
			if ($lc == "Logistikzentrum Lucernate di Rho" || $lc == "Logistikzentrum Verona") {
				$sql = "SELECT * FROM c2c_intl WHERE `From compound` = '$lcx' AND `To compound` = '$lc' LIMIT 1";
				$result_array = self::find_by_sql($sql);
				return !empty($result_array) ? array_shift($result_array) : false ;
			} else {
				$sql = "SELECT * FROM c2c_intl WHERE `From compound` = '$lcx' AND `To compound` = 'Logistikzentrum Lucernate di Rho' LIMIT 1";
				$result_array = self::find_by_sql($sql);
				$tratto1 = !empty($result_array) ? array_shift($result_array) : false ;
				$tratto2 = self::lc_to_lc("Logistikzentrum Lucernate di Rho", $lc);
				$tratto1->price = ($tratto1->price + $tratto2->price);
				$tratto1->to_compound = $tratto2->to_compound;
				return $tratto1;
			}
		} else { return $blank; }
	}

	public static function lc_to_zip($from="", $to="") {
		$blank = self::check_for_blank($from, $to);
		if (empty($blank)) {
			$sql = "SELECT * FROM c2m_dom WHERE `From compound` = '$from' AND `To zip code region` = '$to' LIMIT 1";
			$result_array = self::find_by_sql($sql);
			return !empty($result_array) ? array_shift($result_array) : false ;
		} else { return $blank; }
	}

	public static function lcx_to_zip($from="", $to="") {
		$blank = self::check_for_blank($from, $to);
		if (empty($blank)) {
			$sql = "SELECT * FROM c2m_intl WHERE `From compound` = '$from' AND `To zip code region` = '$to' LIMIT 1";
			$result_array = self::find_by_sql($sql);
			return !empty($result_array) ? array_shift($result_array) : false ;
		} else { return $blank; }
	}

	public static function branch_to_lc($filiale="", $lc="") {
		$blank = self::check_for_blank($filiale, $lc);
		if (empty($blank)) {
			$branch_inserita = Branch::find_by_filiale($filiale);
			$result = self::lc_to_lc($branch_inserita->lc_associato, $lc);
			$result->from_branch = $filiale;
			return $result;
		} else { return $blank; }

	}

	public static function branch_to_zip($filiale="", $zip="") {
		$blank = self::check_for_blank($filiale, $zip);
		if (empty($blank)) {
			$branch_inserita = Branch::find_by_filiale($filiale);
			$result = self::lc_to_zip($branch_inserita->lc_associato, $zip);
			$result->from_branch = $filiale;
			return $result;
		} else { return $blank; }
	}

	public static function enumerate_lcs() {
		return self::find_by_sql("SELECT DISTINCT `From compound` FROM c2c_dom ORDER BY `From compound` ASC");
	}
	public static function lcs_menu($name, $tipo) {
		global $_POST;
		echo '<select  style="width:50%" name="'.$name.'">';
		echo "<option selected>";
		echo "";
		echo "</option>";
		$lcs = self::enumerate_lcs();
		foreach ($lcs as $lc) {
			echo ($_POST["$tipo"] == "lc" && $lc->from_compound == $_POST["$name"]) ? '<option selected>' : '<option>' ;
			echo $lc->from_compound;
			echo "</option>";
		}
		echo "</select>";
//		mysqli_free_result($field_set);
	}

	public static function enumerate_lcxs() {
		return self::find_by_sql("SELECT DISTINCT `From compound` FROM c2c_intl ORDER BY `From compound` ASC");
	}
	public static function lcxs_menu($name) {
		global $_POST;
		echo '<select style="width:70%" name="'.$name.'">';
		echo "<option selected>";
		echo "";
		echo "</option>";
		$lcxs = self::enumerate_lcxs();
		foreach ($lcxs as $lcx) {
			echo ($_POST["tipo_origine"] == "lcx" && $lcx->from_compound == $_POST["$name"]) ? '<option selected>' : '<option>' ;
			echo $lcx->from_compound;
			echo "</option>";
		}
		echo "</select>";
//		mysqli_free_result($field_set);
	}

	public static function enumerate_zips() {
		return self::find_by_sql("SELECT DISTINCT `To zip code region` FROM c2m_dom ORDER BY `To zip code region` ASC");
	}
	public static function zips_menu($name) {
		global $_POST;
		echo '<select style="width:35%" name="'.$name.'">';
		echo "<option selected>";
		echo "";
		echo "</option>";
 		//mancano i zip: 49 68 69 77 78 79
		$zips = self::enumerate_zips();
		foreach ($zips as $zip) {
			echo ($_POST["tipo_destino"] == "zip" && $zip->to_zip == $_POST["$name"]) ? '<option selected>' : '<option>' ;
			echo $zip->to_zip;
			echo "</option>";
		}
		echo "</select>";
	}

}

?>
