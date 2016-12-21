<?php
class Veicolo {

	public $targa ="";
	public $stock_id ="";
	public $tt2120 ="";
	public $tt2120cs ="";
	public $aci_pra ="";
	public $aci_pracs ="";
	public $contratto ="";
	public $cciaa ="";
	public $privacy ="";
	public $doc_rico ="";

	private static function instantiate($result) {
		$object = new self;
		isset($result["Targa"]) ? $object->targa = $result["Targa"] : false ;

		isset($result["StockID"]) ? $object->stock_id = $result["StockID"] : $object->stock_id = "" ;

		isset($result["TT2120"]) ? $object->tt2120 = $result["TT2120"] : false ;
		isset($result["TT2120cs"]) ? $object->tt2120cs = $result["TT2120cs"] : false ;
		isset($result["ACI-PRA"]) ? $object->aci_pra = $result["ACI-PRA"] : false ;
		isset($result["ACI-PRAcs"]) ? $object->aci_pracs = $result["ACI-PRAcs"] : false ;

		isset($result["Contratto"]) ? $object->contratto = $result["Contratto"] : false ;
		isset($result["CCIAA"]) ? $object->cciaa = $result["CCIAA"] : false ;
		isset($result["Privacy"]) ? $object->privacy = $result["Privacy"] : false ;
		isset($result["DocRiconoscim"]) ? $object->doc_rico = $result["DocRiconoscim"] : false ;

		return $object;
	}

	public static function find_by_sql($sql="") {
		global $fp_db;
		$fp_db->open_connection();
		$result_set = $fp_db->query($sql);
		$object_array = array();
		while ($result = mysqli_fetch_assoc($result_set)) {
			$object_array[] = self::instantiate($result);
		}
		return $object_array;
	}

	public static function find_all() {
//		return self::find_by_sql("SELECT * FROM `report veicoli in stock e conclusi da meno di 31gg`;");
		return self::find_by_sql("SELECT * FROM `warm_vehicles`;");
	}

	public static function find_by_stock_id($stock_id=1) {
//		$sql = 'SELECT * FROM `report veicoli in stock e conclusi da meno di 31gg` WHERE StockId = "';
		$sql = 'SELECT * FROM `warm_vehicles` WHERE StockId = "';
		$sql .= $stock_id;
		$sql .= '" LIMIT 1';
		$result = self::find_by_sql($sql);
		return !empty($result) ? array_shift($result) : false ;
	}

	public function acipra_vs_acipracs() {
		$result = ($this->aci_pra !== "FALSE" || $this->aci_pracs !== "FALSE") ? "Ricevuto" : "Non Ricevuto" ;
		echo $result;
	}

	public function tt2120_vs_tt2120cs() {
		$result = ($this->tt2120 !== "FALSE" || $this->tt2120cs !== "FALSE") ? "Ricevuto" : "Non Ricevuto" ;
		echo $result;
	}

	public function check_contratto() {
		$result = ($this->contratto !== "FALSE") ? "Ricevuto" : "Non Ricevuto" ;
		echo $result;
	}

	public function check_cciaa() {
		$result = ($this->cciaa !== "FALSE") ? "Ricevuto" : "Non Ricevuto" ;
		echo $result;
	}

	public function check_privacy() {
		$result = ($this->privacy !== "FALSE") ? "Ricevuto" : "Non Ricevuto" ;
		echo $result;
	}

	public function check_doc_rico() {
		$result = ($this->doc_rico !== "FALSE") ? "Ricevuto" : "Non Ricevuto" ;
		echo $result;
	}

}

?>
