<?php
require_once("private/initialize.php");

// $requested_stock_id = $_POST["stock_id"];
$requested_stock_id = "Af1726";
$ab = substr($requested_stock_id ,0,2);
$num = substr($requested_stock_id ,2,5);

echo $ab;
echo '<br>';
echo $num;
echo '<br>';
if ( !ctype_alpha($ab) ) {
  echo 'they are not letters';
}
echo '<br>';
if ( !is_numeric($num) ) {
  echo 'not number';
}


echo '<br>';

if ( strlen($requested_stock_id) !== 7 || !ctype_alpha($ab) || !is_numeric($num)) {
  echo '<script>';
  echo 'alert("Attenzione! Lo StockID dev\'essere composto da 2 lettere iniziali seguite da 5 numeri.");';
  echo '</script>';
} else {
  echo "looks good";
}


?>
