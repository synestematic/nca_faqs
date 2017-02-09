<?php
require_once("private/initialize.php");

$veicolo_richiesto = new Veicolo();

if (isset($_POST["submit"])) {

  $requested_stock_id = $_POST["stock_id"];

  $veicolo_richiesto = Veicolo::find_by_stock_id($requested_stock_id);
  if (empty($veicolo_richiesto)) {
    $veicolo_richiesto = new Veicolo();
  }

}
?>
<?php include(LIB_PATH.DS."htmls".DS."header.php"); ?>
 <body bgcolor="#ffffff">
  <div id="documents_div" align="left">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="submit" name="submit" value="Cerca" />
      <input id="input_field" type="text" name="stock_id" value="<?php echo (isset($requested_stock_id)) ? "$requested_stock_id" : "Stock ID" ; ?>" />
    </form>
    <br>
    <?php
    echo ($veicolo_richiesto->tipo !== "Vendita Italia") ? '' : '<div id="status">'.$veicolo_richiesto->status.'</div><br>'.'<div id="next_step">'.$veicolo_richiesto->next_step.'</div><br>';
    if ($veicolo_richiesto->status == "In attesa dei documenti mancanti.") {
      echo '<table id="documents_table"><tr><th>TT2120 / ACI-PRA</th><th>CCIAA</th><th>Privacy</th><th>Carta Identità</th></tr><tr><td>';
      if ($veicolo_richiesto->tipo !== "Vendita Italia") {
            echo "";
      } else {
             echo ($veicolo_richiesto->tt2120_vs_tt2120cs() !== FALSE ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
      }
      echo  "</td><td>";
      if ($veicolo_richiesto->tipo !== "Vendita Italia") {
            echo "";
      } else {
             echo ($veicolo_richiesto->cciaa !== "FALSE" ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
      }
      echo  "</td><td>";
      if ($veicolo_richiesto->tipo !== "Vendita Italia") {
           echo "";
      } else {
             echo ($veicolo_richiesto->privacy !== "FALSE" ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
      }
      echo  "</td><td>";
      if ($veicolo_richiesto->tipo !== "Vendita Italia") {
            echo "";
      } else {
             echo ($veicolo_richiesto->doc_rico !== "FALSE" ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
      }
      echo  "</td></tr></table>";
   } ?>
  </div>
  <?php
  if (isset($_POST["submit"])) {
    // this is done at the end so the message appears after the html has been rendered

    $ab = substr($requested_stock_id ,0,2);
    $num = substr($requested_stock_id ,2,5);

    if ( strlen($requested_stock_id) !== 7 || !ctype_alpha($ab) || !is_numeric($num)) {
      echo '<script src="js/documents.alert.js"></script>';
    } else {
      if ($veicolo_richiesto->stock_id == "" || $veicolo_richiesto->tipo !== "Vendita Italia") {
        echo '<script>';
        echo 'alert("Lo Stock ID inserito non e\' presente nel nostro database di documenti.\n\nL\'assenza potrebbe essere dovuta al fatto che il pagamento non è stato ricevuto.\nIl pagamento per essere processato e ricevuto impiega tra le 24 e le 72 ore, data valuta.\n\nIl database di documenti viene aggiornato entro 24h dal momento in cui il vostro pagamento viene ricevuto da Auto1.");';
        echo '</script>';
      }
    }
  }
?>
 <script src="js/documents.js"></script>
 </body>
 <?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
