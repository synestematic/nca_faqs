<?php
setlocale(LC_TIME, 'it_IT');
setlocale(LC_ALL, 'it_IT');

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

	public $status ="";
	public $next_step ="";

	public $tipo ="";
	public $data_cdc ="";
	public $data_incarico ="";
	public $data_evento ="";

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

		isset($result["Tipo"]) ? $object->tipo = $result["Tipo"] : false ;
		isset($result["DataCdC"]) ? $object->data_cdc = $result["DataCdC"] : false ;
		isset($result["DataIncarico"]) ? $object->data_incarico = $result["DataIncarico"] : false ;
		isset($result["Data_Evento"]) ? $object->data_evento = $result["Data_Evento"] : false ;

		// non si fa piu'
		// if ($object->data_cdc === "" ) { $object->status .= "In attesa dei documenti di circolazione."; }

		// non si fa piu'
		// if ($object->data_incarico === "" ) { $object->status .= "In attesa dell'acquisto o pagamento dell'auto da parte del merchant."; }

		if ($object->tt2120_vs_tt2120cs() === FALSE || $object->cciaa === "FALSE" || $object->privacy === "FALSE" || $object->doc_rico === "FALSE" ) {
			$object->status = "In attesa dei documenti mancanti.";
			$object->next_step = "Se i documenti non sono stati spediti seguire la mail di istruzioni inviata da Finproget.<br>Se avete già effettuato la spedizione dei documenti in originale, potete verificare lo stato della consegna dei documenti con il tracking code fornito da DHL."; // <br>Fare riferimento alla tabella di seguito.
		}

		if ($object->tt2120_vs_tt2120cs() !== FALSE &&
			$object->cciaa !== "FALSE" &&
			$object->privacy !== "FALSE" &&
			$object->doc_rico !== "FALSE" &&
			// $object->data_cdc !== "" && non si fa piu'
			$object->data_incarico !== "" &&
			$object->data_evento === "" ) {
				$object->status = "Passaggio di proprietà in lavorazione da Finproget.";
				$object->next_step = "Finproget vi invierà una mail di notifica non appena il passaggio di proprietà sarà finalizzato.";
		}

		if ($object->data_evento !== "" ) {
			$object->status .= "Passaggio di proprietà finalizzato in data ". utf8_encode(strftime("%d %B %Y", strtotime($object->data_evento))).".";
			$object->next_step = "Nella mail di conferma di Finproget troverete il tracking della spedizione dei documenti della vettura e le istruzioni in caso di pick-up dell'auto.";
		}

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
		global $fp_db;
		$fp_db->open_connection();
		$sql = 'SELECT * FROM `warm_vehicles` WHERE StockId = "';
		$sql .= $fp_db->escape_string($stock_id);
		//$sql .= $stock_id;
		$sql .= '" LIMIT 1';
		$result = self::find_by_sql($sql);
		return !empty($result) ? array_shift($result) : false ;
	}

	// non si fa piu'
	// public function acipra_vs_acipracs() {
	// 	return ($this->aci_pra !== "FALSE" || $this->aci_pracs !== "FALSE") ? TRUE : FALSE ;
	// }

	public function tt2120_vs_tt2120cs() {
		return ($this->tt2120 !== "FALSE" || $this->tt2120cs !== "FALSE") ? TRUE : FALSE ;
	}

}

?>
