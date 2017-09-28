<?php

//this file contains constants for database connections
//see the incoming parameters for dbConnect for example
require_once("const.inc");

class DB {
        
  private $_dbConn = null;
  private $_server = "localhost";
  private $_user = "USER";
  private $_pass = "PASSWORD";
  private $_db = "DATABASE";

  public function logError($errorMesg = "Error",$errorDetails = null) {
    error_log($errorMesg);
    foreach ($errorDetails as $error) {
      error_log($error);
    }
 }

  public function dbEsc($term) {
    if (!is_resource($this->_dbConn)) {
      $this->dbConnect();
    }
    if (is_array($term)) {
      $tempArray = array();
      foreach ($term as $key => $value) {
        $tempArray['$key'] = mysqli_real_escape_string($this->_dbConn,$value);
      }
      return $tempArray;
    } else { //it's not an array so just send it back
        return mysqli_real_escape_string($this->_dbConn,$term);
    }

  } //end function dbEsc

  public function dbConnect($server = MSERVER,
                            $user = MUSER,
                            $pass = MPASS,
                            $db = MDB) {

    $this->_server = $server;
    $this->_pass = $pass;
    $this->_user = $user;
    $this->_db = $db;

    $link = mysqli_connect($this->_server,$this->_user,$this->_pass);
    if (!$link) {
        $this->logError("Cannot connect to db at this time",mysqli_error($link));
        return false;
        exit;
    }
    $dbSel = mysqli_select_db($link,$this->_db);
    if (!$dbSel) {
        $this->logError("Cannot select db: ",mysqli_error($link));
        return false;
        exit;
    }
    $this->_dbConn = $link;
  } //end function DBConnect()

  public function returnDB($server = MSERVER,
                            $user = MUSER,
                            $pass = MPASS,
                            $db = MDB) {

    $this->_server = $server;
    $this->_pass = $pass;
    $this->_user = $user;
    $this->_db = $db;

    $link = mysqli_connect($this->_server,$this->_user,$this->_pass);
    if (!$link) {
        $this->logError("Cannot connect to db at this time",mysqli_error($link));
        return false;
        exit;
    }
    $dbSel = mysqli_select_db($link,$this->_db);
    if (!$dbSel) {
        $this->logError("Cannot select db: ",mysqli_error($link));
        return false;
        exit;
    }
    return $link;
  } //end function returnDB

  public function getCaller() {
    $backtrace = debug_backtrace();
    return $backtrace[1]['function'];
  } //end function getCaller

  public function dbCall($sql,$resultType = null) {
    $result = mysqli_query($this->_dbConn,$sql);
    if (!$result) {
      $caller = $this->getCaller();
      $details = array('caller' => $caller,'error' => mysqli_error($this->_dbConn));
      $this->logError("Error with database call",$details);
      return false;
    } //end if not result

    if (preg_match('/^INSERT/i',$sql)) {
      return mysqli_insert_id($this->_dbConn);
    } else if (preg_match('/^UPDATE/i',$sql)) {
      return mysqli_affected_rows($this->_dbConn);
    } else {
      $returnArray = array();
      switch ($resultType) {
        default:
        case "assoc":
          while ($resultArray = mysqli_fetch_assoc($result)) {
            $returnArray[] = $resultArray;
          }
          return $returnArray;
          break;
      } //end switch for result type
    }
  } //end function dbCall()

} //end class DB
?>
