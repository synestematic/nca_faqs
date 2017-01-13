<?php
setlocale(LC_TIME, 'it_IT');
setlocale(LC_ALL, 'it_IT');

echo utf8_encode(strftime("%A %d %B %Y", time()));

echo "<br>";
// echo date("F d, Y", strtotime("now"));

 ?>
