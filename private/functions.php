<?php

function redirect($location) {
  header("Location: " . $location);
  exit;
}

function __autoload($class) {
  $filename = strtolower($class);
  $path = LIB_PATH.DS."$filename.php";
  if (file_exists($path)) {
    require_once($path);
  } else {
    die("$class class not found and __autoloader not able to make up for it.");
  }
}

?>
