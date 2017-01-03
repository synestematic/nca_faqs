<?php
require_once("private/initialize.php");

// you can treat string characters as if they were array keys....
$foo = "1b3";
echo $foo[1]; // displays b
echo '<br>';
$foo[0] = 'a'; // inserts a in frist place
echo $foo; // displays ab3

?>
