<?php

define("MUSER","YOUR_USERNAME");
define("MPASS","YOUR_PASSWORD");
define("MSERVER","SERVER_NAME_GOES_HERE");
define("MDB","DATABASE_NAME_GOES_HERE");

if (basename($_SERVER['PHP_SELF']) == "const.php") {
  die(header("HTTP/1.0 404 Not Found"));
}

?>
