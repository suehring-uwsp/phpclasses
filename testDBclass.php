<?php

require_once("DB.class.php");

$db = new DB();

$db->dbConnect();

/*
//INSERT example
$query = "INSERT INTO testschema (username,pass,active) " .
          "VALUES ('bob','l33t',1)";

$safeQuery = $db->dbEsc($query);

$result = $db->dbCall($query);

//This will contain the insert id
print "Insert statement executed, insert id was: " . $result . "\n";
*/

$query = "SELECT username FROM testschema WHERE active = 1";
$safeQuery = $db->dbEsc($query);
$result = $db->dbCall($query);

var_dump($result);

/*
//UPDATE example
$query = "UPDATE testschema SET pass = 'testpass' WHERE id = 1";
$safeQuery = $db->dbEsc($query);
$result = $db->dbCall($query);

print "Update statement executed, affected rows: " . $result . "\n";
*/

?>
