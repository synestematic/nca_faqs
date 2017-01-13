<?php
class Transport {
// Haven't done any escaping on this class SQL values as they are not directly input by users but are chosen from select html object
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

		if (isset($result["Final Invoice rate"])) {
			$object->price = number_format($result["Final Invoice rate"], 2, ',', ' ');
		}
		if (isset($result["New final Invoice rate"])) {
			$object->price = number_format($result["New final Invoice rate"], 2, ',', ' ');
		}

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

	public function check_for_same_lc() {
		return ($this->from_compound == $this->to_compound) ? true : false ;
	}

	public static function check_for_blank($origine, $destino) {
		if ($origine == "" || $destino == "") {
			return new self;
		} else {
			return false;
		}
	}

	public function lc_to_lc() {
				$check_same_lc = $this->check_for_same_lc();
				if ($check_same_lc == false ) {
					$sql = "SELECT * FROM c2c_dom WHERE `From compound` = '$this->from_compound' AND `To compound` = '$this->to_compound' LIMIT 1";
					$result_array = self::find_by_sql($sql);
					$result = !empty($result_array) ? array_shift($result_array) : false ;
					$this->price = $result->price;
				} else {
					$this->price = "nessun costo";
				}
	}

	public function lcx_to_lc() {
			if ($this->to_compound == "Logistikzentrum Lucernate di Rho" || $this->to_compound == "Logistikzentrum Verona") {
				$sql = "SELECT * FROM c2c_intl WHERE `From compound` = '$this->from_compound' AND `To compound` = '$this->to_compound' LIMIT 1";
				$result_array = self::find_by_sql($sql);
				$result = !empty($result_array) ? array_shift($result_array) : false ;
				$this->price = $result->price;

			} else {

				$sql = "SELECT * FROM c2c_intl WHERE `From compound` = '$this->from_compound' AND `To compound` = 'Logistikzentrum Lucernate di Rho' LIMIT 1";
				$result_array = self::find_by_sql($sql);
				$tratto1 = !empty($result_array) ? array_shift($result_array) : false ;

				$tratto2 = new self;
				$tratto2->from_compound = "Logistikzentrum Lucernate di Rho";
				$tratto2->to_compound = $this->to_compound;
				$tratto2->lc_to_lc();

				$this->price = $tratto1->price + $tratto2->price;

			}
	}

	public function lc_to_zip() {
			$sql = "SELECT * FROM c2m_dom WHERE `From compound` = '$this->from_compound' AND `To zip code region` = '$this->to_zip' LIMIT 1";
			$result_array = self::find_by_sql($sql);
			$result = !empty($result_array) ? array_shift($result_array) : false ;
			$this->price = $result->price;
	}

	public function lcx_to_zip() {
			$sql = "SELECT * FROM c2m_intl WHERE `From compound` = '$this->from_compound' AND `To zip code region` = '$this->to_zip' LIMIT 1";
			$result_array = self::find_by_sql($sql);
			$result = !empty($result_array) ? array_shift($result_array) : false ;
			$this->price = $result->price;
	}

	public function branch_to_lc() {
			$branch_inserita = Branch::find_by_filiale($this->from_branch);
			$this->from_compound = $branch_inserita->lc_associato;
			$this->lc_to_lc();
	}

	public function branch_to_zip() {
			$branch_inserita = Branch::find_by_filiale($this->from_branch);
			$this->from_compound = $branch_inserita->lc_associato;
			$this->lc_to_zip();
	}

	public static function enumerate_lcs() {
		return self::find_by_sql("SELECT DISTINCT `From compound` FROM c2c_dom ORDER BY `From compound` ASC");
	}
	public static function lcs_menu($name) {
		global $_POST;
		if ($name === "lc_origine") {
			echo '<select id="lc_select" onchange="reset13();" style="width:80%" name="'.$name.'">';
		}
		if ($name === "lc_destino") {
			echo '<select id="lc_selector" onchange="reset5();" style="width:80%" name="'.$name.'">';
		}
		echo "<option selected>";
		echo "";
		echo "</option>";
		$lcs = self::enumerate_lcs();
		foreach ($lcs as $lc) {
			echo ($lc->from_compound == $_POST["$name"]) ? '<option selected>' : '<option>' ;
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
		echo '<select id="lcx_select" onchange="reset12();" style="width:80%" name="'.$name.'">';
		echo "<option selected>";
		echo "";
		echo "</option>";
		$lcxs = self::enumerate_lcxs();
		foreach ($lcxs as $lcx) {
			echo ($lcx->from_compound == $_POST["$name"]) ? '<option selected>' : '<option>' ;
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
		echo '<select id="zip_select" onchange="reset4();" style="width:80%" name="'.$name.'">';
		echo "<option selected>";
		echo "";
		echo "</option>";
 		//mancano i zip: 49 68 69 77 78 79
		$zips = self::enumerate_zips();
		foreach ($zips as $zip) {
			echo ($zip->to_zip == $_POST["$name"]) ? '<option selected>' : '<option>' ;
			echo $zip->to_zip;
			echo "</option>";
		}
		echo "</select>";
	}

}

?>
