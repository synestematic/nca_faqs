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
 <body background="#ffffff">
  <div id="documents_div" align="left">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="submit" name="submit" value="Cerca" />
      <input id="input_field" type="text" name="stock_id" value="<?php echo (isset($requested_stock_id)) ? "$requested_stock_id" : "Stock ID" ; ?>" />
    </form>
    <br>
    <table id="documents_table">
      <tr>
        <th>TT2120</th><th>ACI-PRA</th><th>CCIAA</th><th>Privacy</th><th>Riconoscimento</th>
      </tr>
      <tr>
        <td>
        <?php
        if ($veicolo_richiesto->tipo !== "Vendita Italia") {
              echo "";
        } else {
               echo ($veicolo_richiesto->tt2120_vs_tt2120cs() !== FALSE ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
        }
        ?>
        </td>
        <td>
        <?php
        if ($veicolo_richiesto->tipo !== "Vendita Italia") {
              echo "";
        } else {
               echo ($veicolo_richiesto->acipra_vs_acipracs() !== FALSE ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
        }
        ?>
        </td>
        <td>
        <?php
        if ($veicolo_richiesto->tipo !== "Vendita Italia") {
              echo "";
        } else {
               echo ($veicolo_richiesto->cciaa !== "FALSE" ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
        }
        ?>
        </td>
        <td>
          <?php
          if ($veicolo_richiesto->tipo !== "Vendita Italia") {
                echo "";
          } else {
                 echo ($veicolo_richiesto->privacy !== "FALSE" ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
          }
          ?>
        </td>
        <td>
           <?php
          if ($veicolo_richiesto->tipo !== "Vendita Italia") {
                echo "";
          } else {
                 echo ($veicolo_richiesto->doc_rico !== "FALSE" ) ? '<div id="got">Ricevuto</div>' : '<div id="not">Non Ricevuto</div>' ;
          }
          ?>
        </td>
      </tr>
   </table><br>
    <?php echo ($veicolo_richiesto->tipo !== "Vendita Italia") ? '' : $veicolo_richiesto->status; ?>
    <br><br><br>
  </div>
  <?php

  if (isset($_POST["submit"])) {
    $ab = substr($requested_stock_id ,0,2);
    $num = substr($requested_stock_id ,2,5);

    if ( strlen($requested_stock_id) !== 7 || !ctype_alpha($ab) || !is_numeric($num)) {
      echo '<script src="js/documents.alert.js"></script>';
    } else {
      if ($veicolo_richiesto->stock_id == "") {
        echo '<script>';
        echo 'alert("Lo Stock ID inserito non e\' presente nel nostro database.");';
        echo '</script>';
      }
    }
  }
?>
 <script src="js/documents.js"></script>
 </body>
 <?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
