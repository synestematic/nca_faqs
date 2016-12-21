<?php
require_once("private/initialize.php");

if (isset($_POST["submit"]) && isset($_POST["tipo_origine"]) && isset($_POST["tipo_destino"])) {

  // set new transport with POST variables and use instance methods instead of class methods

    //C2M DOMESTIC + branch
    if ($_POST["tipo_origine"] == "lc" && $_POST["tipo_destino"] == "zip") {
      $transport_richiesto = Transport::lc_to_zip($_POST["lc_origine"], $_POST["zip_destino"]);
    }
    if ($_POST["tipo_origine"] == "branch" && $_POST["tipo_destino"] == "zip") {
      $transport_richiesto = Transport::branch_to_zip($_POST["branch_origine"], $_POST["zip_destino"]);
    }

    //C2C DOMESTIC + branch
    if ($_POST["tipo_origine"] == "lc" && $_POST["tipo_destino"] == "lc") {
      $transport_richiesto = Transport::lc_to_lc($_POST["lc_origine"], $_POST["lc_destino"]);
    }
    if ($_POST["tipo_origine"] == "branch" && $_POST["tipo_destino"] == "lc") {
      $transport_richiesto = Transport::branch_to_lc($_POST["branch_origine"], $_POST["lc_destino"]);
    }

    //C2M INTL
    if ($_POST["tipo_origine"] == "lcx" && $_POST["tipo_destino"] == "zip") {
      $transport_richiesto = Transport::lcx_to_zip($_POST["lcx_origine"], $_POST["zip_destino"]);
    }

    //C2C INTL
    if ($_POST["tipo_origine"] == "lcx" && $_POST["tipo_destino"] == "lc") {
      $transport_richiesto = Transport::lcx_to_lc($_POST["lcx_origine"], $_POST["lc_destino"]);
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
		 <td align="center" style="width:50px">ORIGINE:</td>
     <td style="width:300px" align="right">Filiale in Italia<input type="radio" name="tipo_origine" value="branch" <?php echo (isset($_POST["tipo_origine"]) && $_POST["tipo_origine"] == "branch") ? 'checked' : '' ; ?> ></td>
		 <td style="width:300px" align="right"><?php Branch::branches_menu("branch_origine"); ?></td>
     </tr>
     <tr>
       <td></td>
		 <td align="right">Centro di Stoccaggio in Italia<input type="radio" name="tipo_origine" value="lc" <?php echo (isset($_POST["tipo_origine"]) && $_POST["tipo_origine"] == "lc") ? 'checked' : '' ; ?> ></td>
		 <td align="right">
			 <?php Transport::lcs_menu("lc_origine", "tipo_origine"); ?>
		 </td>
	   </tr>
     <tr>
       <td></td>
		 <td align="right">Centro di Stoccaggio all'Estero<input type="radio" name="tipo_origine" value="lcx" <?php echo (isset($_POST["tipo_origine"]) && $_POST["tipo_origine"] == "lcx") ? 'checked' : '' ; ?> ></td>
		 <td align="right">
			 <?php Transport::lcxs_menu("lcx_origine"); ?>
		 </td>
	   </tr>
   <tr>
     <td>&nbsp</td><td></td><td></td>
   </tr>
	 	<tr>
			<td align="center">DESTINAZIONE:</td>
		 	<td align="right"> Centro di Stoccaggio in Italia<input type="radio" name="tipo_destino" value="lc" <?php echo (isset($_POST["tipo_destino"]) && $_POST["tipo_destino"] == "lc") ? 'checked' : '' ; ?>></td>
		 	<td align="left">
        <?php Transport::lcs_menu("lc_destino", "tipo_destino"); ?>
		 	</td>
	 	</tr>
		<tr>
		 <td>
		 </td>
		 <td align="right"> Codice Postale (prime due cifre)<input type="radio" name="tipo_destino" value="zip" <?php echo (isset($_POST["tipo_destino"]) && $_POST["tipo_destino"] == "zip") ? 'checked' : '' ; ?>></td>
		 <td align="left">
       <?php Transport::zips_menu("zip_destino"); ?>
		 </td>
	 	</tr>
	</table><br>
  <table id="transport_table"><tr>
    <td style="width:50px"><input type="submit" name="submit" value="Calcola" /></td>
    <td style="width:300px" align="right"> <div id="prezzo_di_spedizione"><i>Prezzo di Spedizione = </i></div></td>
    <td style="width:300px" align="left"><div id="prezzo">
      <?php
        echo (empty($transport_richiesto)) ? '' : '<i>€ '.$transport_richiesto->price.'</i>';
      ?> </div>
    </td>
  </tr></table>
  </form>
  </div>
  </font>
 </body>
 <?php include(LIB_PATH.DS."htmls".DS."footer.php"); ?>
