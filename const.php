<?php

define("MUSER","YOURUSER");
define("MPASS","YOURPASS");
define("MSERVER","YOURSERVER");
define("MDB","YOURDB");

if (basename($_SERVER['PHP_SELF']) == "const.php") {
  die(header("HTTP/1.0 404 Not Found"));
}

?>
