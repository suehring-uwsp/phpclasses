<?php

require_once("DB.class.php");

$db = new DB();

//var_dump($db);

if (!$db->getConnStatus()) {
  print "An error has occurred with connection\n";
  exit;
}

/*
//INSERT example
//Pretend this is unsanitized
//user data from a form:
$user = "bob";
$safeUser = $db->dbEsc($user);

$query = "INSERT INTO testschema (username,pass,active) " .
          "VALUES ('{$safeUser}','l33t',1)";
$result = $db->dbCall($query);

//This will contain the insert id
print "Insert statement executed, insert id was: " . $result . "\n";
*/

//If using unsanitized data, be sure
//to call the dbEsc() method on any individual values!
// Must do that prior to building the statement here

$query = "SELECT username FROM testschema WHERE active = 1";

$result = $db->dbCall($query);

var_dump($result);

/*
//UPDATE example
//If using unsanitized data, be sure
//to call the dbEsc() method on any individual values!
// Must do that prior to building the statement here

$query = "UPDATE testschema SET pass = 'testpass' WHERE id = 1";
$result = $db->dbCall($query);

print "Update statement executed, affected rows: " . $result . "\n";
*/
?>
