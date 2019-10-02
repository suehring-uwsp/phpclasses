<?php

require_once("DB.class.php");

$db = new DB();

//This can sometimes be helpful when learning how to use the class.
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
if (!$result) {
  //use friendly error messaging, not this:
  print "Error: " . var_dump($db->getDBError());
} else {
  //This will contain the insert id
  print "Insert statement executed, insert id was: " . $result . "\n";
  //Reset result when done with it to prevent interfering with later calls.
  $result = false;
}
*/


//If using unsanitized data, be sure to call the dbEsc() 
// method on any individual values!
// Must do that prior to building the statement here

$query = "SELECT username FROM testschema WHERE active = 1";

$result = $db->dbCall($query);
if (!$result) {
  //use friendly error messaging, not this:
  print "Error: " . var_dump($db->getDBError());
} else {
  //do something useful with the results rather than var_dump
  var_dump($result);
  //Reset result when done with it to prevent interfering with later calls.
  $result = false;
}

/*
//UPDATE example
//If using unsanitized data, be sure to call the dbEsc() method 
// on any individual values!
// Must do that prior to building the statement here

$query = "UPDATE testschema SET username = 'testuser' WHERE id = 5";
$result = $db->dbCall($query);
if (!$result) {
  //use friendly error messaging, not this:
  print "Error: " . var_dump($db->getDBError());
} else {
  print "Update statement executed, affected rows: " . $result . "\n";
  //Reset result when done with it to prevent interfering with later calls.
  $result = false;
}
*/
