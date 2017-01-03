<?php
require_once("private/initialize.php");

if (isset($_POST["submit"])) {

  $requested_stock_id = $_POST["stock_id"];

  $veicolo_richiesto = Veicolo::find_by_stock_id($requested_stock_id);
  if (empty($veicolo_richiesto)) {
    $veicolo_richiesto = new Veicolo();
  }

}
?>
<?php include(LIB_PATH.DS."htmls".DS."header.php"); ?>
 <body>
  <div id="documents_div" align="left">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      Stock ID
      <input type="text" name="stock_id" value="<?php echo (isset($requested_stock_id)) ? "$requested_stock_id" : "" ; ?>" />
      <input type="submit" name="submit" value="Cerca" />
    </form><br>
    <table id="documents_table">
      <tr>
        <th>TT2120</th><th>ACI-PRA</th><th>CCIAA</th><th>Privacy</th><th>Documento di Riconoscimento</th>
      </tr>
      <tr>
        <td>
        <?php
        if (isset($veicolo_richiesto->tt2120)) {
          if (!$veicolo_richiesto->tt2120 == "") {
            // echo $veicolo_richiesto->tt2120." ";
            // echo $veicolo_richiesto->tt2120cs." ";
            $veicolo_richiesto->tt2120_vs_tt2120cs();
          }
        }
        ?>
        </td>
        <td>
        <?php
        if (isset($veicolo_richiesto->aci_pra)) {
          if (!$veicolo_richiesto->aci_pra == "") {
            // echo $veicolo_richiesto->aci_pra." ";
            // echo $veicolo_richiesto->aci_pracs." ";
            $veicolo_richiesto->acipra_vs_acipracs();
          }
        }
        ?>
        </td>
        <td>
          <?php
          if (isset($veicolo_richiesto->cciaa)) {
            if (!$veicolo_richiesto->cciaa == "") {
              // echo $veicolo_richiesto->cciaa." ";
              $veicolo_richiesto->check_cciaa();
            }
          }
          ?>
        </td>
        <td>
          <?php
          if (isset($veicolo_richiesto->privacy)) {
            if (!$veicolo_richiesto->privacy == "") {
              // echo $veicolo_richiesto->privacy." ";
              $veicolo_richiesto->check_privacy();
            }
          }
          ?>
        </td>
        <td>
          <?php
          if (isset($veicolo_richiesto->doc_rico)) {
            if (!$veicolo_richiesto->doc_rico == "") {
              // echo $veicolo_richiesto->doc_rico." ";
              $veicolo_richiesto->check_doc_rico();
            }
          }
          ?>
        </td>
      </tr>
    </table><br>
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
 </body>
 <?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
