<?php
require_once("private/initialize.php");

//echo Database::escape_string("It's Trivia Time");
echo $local_db->escape_string("It's Trivia Time");
echo '<br>';
$foo = Branch::find_by_id("9");
echo $foo->filiale;
echo '<br>';
$foo = Branch::find_by_filiale("Ancona");
echo $foo->id;
echo '<br>';
$foo = Lc::find_by_id("5");
echo $foo->centro;
echo '<br>';
$foo = Lc::find_by_centro("Logistikzentrum Ostia Antic");
echo $foo->id;
echo '<br>';

?>
