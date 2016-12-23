<?php
require_once("private/initialize.php");

if (isset($_POST["submit"])) {

  $transport_richiesto = new Transport();

  if ( ( ($_POST["branch_origine"] !== "") && ($_POST["lcx_origine"] !== "") ) ||
       ( ($_POST["branch_origine"] !== "") && ($_POST["lc_origine"] !== "") ) ||
       ( ($_POST["lcx_origine"] !== "") && ($_POST["lc_origine"] !== "") ) ||
       ( ($_POST["lc_destino"] !== "") && ($_POST["zip_destino"] !== "") ) ||
       ( ($_POST["branch_origine"] == "") && ($_POST["lc_origine"] == "") && ($_POST["lcx_origine"] == "") ) ||
       ( ($_POST["lc_destino"] == "") && ($_POST["zip_destino"] == "") )
     ) {
    $transport_richiesto->price = "";
    echo '<script>';
    echo 'alert("Attenzione! Scegliere 1 Origine e 1 Destinazione.");';
    echo '</script>';
  }
  else {
    //C2M DOMESTIC + branch
    if (($_POST["lc_origine"] !== "") && ($_POST["zip_destino"] !== "")) {
      $transport_richiesto->from_compound = $_POST["lc_origine"];
      $transport_richiesto->to_zip = $_POST["zip_destino"];
      $transport_richiesto->lc_to_zip();
    }
    if (($_POST["branch_origine"] !== "") && ($_POST["zip_destino"] !== "")) {
      $transport_richiesto->from_branch = $_POST["branch_origine"];
      $transport_richiesto->to_zip = $_POST["zip_destino"];
      $transport_richiesto->branch_to_zip();
    }
    //C2C DOMESTIC + branch
    if (($_POST["lc_origine"] !== "") && ($_POST["lc_destino"] !== "")) {
      $transport_richiesto->from_compound = $_POST["lc_origine"];
      $transport_richiesto->to_compound = $_POST["lc_destino"];
      $transport_richiesto->lc_to_lc();
    }
    if (($_POST["branch_origine"] !== "") && ($_POST["lc_destino"] !== "")) {
      $transport_richiesto->from_branch = $_POST["branch_origine"];
      $transport_richiesto->to_compound = $_POST["lc_destino"];
      $transport_richiesto->branch_to_lc();
    }
    //C2M INTL
    if (($_POST["lcx_origine"] !== "") && ($_POST["zip_destino"] !== "")) {
      $transport_richiesto->from_compound = $_POST["lcx_origine"];
      $transport_richiesto->to_zip = $_POST["zip_destino"];
      $transport_richiesto->lcx_to_zip();
    }
    //C2C INTL
    if (($_POST["lcx_origine"] !== "") && ($_POST["lc_destino"] !== "")) {
      $transport_richiesto->from_compound = $_POST["lcx_origine"];
      $transport_richiesto->to_compound = $_POST["lc_destino"];
      $transport_richiesto->lcx_to_lc();
    }
  }
}
?>
<?php include(LIB_PATH.DS."htmls".DS."header.php"); ?>
 <body>
   <basefont face="Verdana" size="">
  <div id="transport_div">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	 <table id="transport_table">
		<tr>
		 <td style="width:50px"></td>
     <td style="width:300px" align="right">Filiale in Italia</td>
		 <td style="width:300px" align="right"><?php Branch::branches_menu("branch_origine"); ?></td>
     </tr>
     <tr>
      <td style="width:50px"><div id="oridest">ORIGINE:</div></td>
		 <td align="right">Centro di Stoccaggio in Italia</td>
		 <td align="right">
			 <?php Transport::lcs_menu("lc_origine"); ?>
		 </td>
	   </tr>
     <tr>
       <td></td>
		 <td align="right">Centro di Stoccaggio all'Estero</td>
		 <td align="right">
			 <?php Transport::lcxs_menu("lcx_origine"); ?>
		 </td>
	   </tr>
   <tr>
     <td>&nbsp</td><td></td><td></td>
   </tr>
	 	<tr>
			<td><div id="oridest">DESTINAZIONE:</div></td>
		 	<td align="right"> Centro di Stoccaggio in Italia</td>
		 	<td align="left">
        <?php Transport::lcs_menu("lc_destino"); ?>
		 	</td>
	 	</tr>
		<tr>
		 <td>
		 </td>
		 <td align="right"> Codice Postale (prime due cifre)</td>
		 <td align="left">
       <?php Transport::zips_menu("zip_destino"); ?>
		 </td>
	 	</tr>
	</table><br>
  <table id="transport_table"><tr>
    <td style="width:50px"><input type="submit" name="submit" value="Calcola" /></td>
    <td style="width:300px" align="right"> <div id="prezzo_di_spedizione"><i>Prezzo di Spedizione = </i></div></td>
    <td style="width:300px" align="left"><div id="prezzo"><i>€
      <?php
        echo (empty($transport_richiesto)) ? '' : $transport_richiesto->price;
      ?></i></div>
    </td>
  </tr></table>
  <?php // echo '<pre>'; print_r($_POST); echo '</pre>'; ?>
  </form>
  </div>
  </font>
 </body>
 <?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
