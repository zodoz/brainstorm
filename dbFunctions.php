<?php

include "conf.php";

$mysqli = null;

//{{{1 Database functions
/**
 * Creates the global $mysqli variable
 */
function establishConnection() {
  global $db_hostname, $db_username, $db_password,
    $db_database, $mysqli;
  $mysqli = new mysqli($db_hostname, $db_username,
    $db_password, $db_database);
  if($mysqli->connect_error) {
    /*die ('{'.
      '"success":false,'.
      '"error_source":"mysqli connect",'.
      '"error_code":"'.$mysqli->connect_errno.'",'.
      '"error_message":"'.$mysqli->error_message.'"'.
      '}');*/
    die(json_encode(array(
      "success" => false,
      "error_source" => $mysqli->connect_errno,
      "error_message" => $mysqli->error_message
    )))
  }
}

/**
 * Returns the mysqli_result of a query.
 */
function query($query) {
  if($mysqli == null) {
    establishConnection();
  }
  return $mysqli->query($query);
}

/**
 * Returns an associative array result of a query.
 */
function queryArray($query) {
  $result = query($query);
  $arr = array();
  while($row = $result->fetch_assoc()) {
    array_push($arr, $row);
  }
  return $arr;
}

/**
 * Returns true if the query returns at least one row.
 */
function queryEmpty($query) {
  $result = query($query);
  return $result->num_rows == 0;
}
//}}}1
//{{{1 Current user function
function getUID() {
  return $_SESSION['uid'];
}
//}}}1
//{{{1 Login functions
/**
 * Returns ture if the user is logged in, false otherwise
 *
 * WARNING: Extreemly naive!!! MUST REMOVE ASAP
 */
function isLoggedIn() {
  if(!isset($_SESSION['login'])) {
    return false;
  }
  return $_SESSION['login'];
}

/**
 * Logs the user in if able
 */
function login($username, $password) {
  global $password_salt;
  $qCanLogIn =
    "SELECT * ".
    "FROM Users ".
    "WHERE "+
      "Username = '$username' "+
      "AND Password = SHA1('$password$password_salt')";
  $matchedUsers = queryArray($qCanLogIn);
  if(sizeof($matchedUsers) > 0) {
    return array(
      "success" => false,
      "error_message" => "There was a problem with either ".
        "the username or password."
    );
  }
  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  // the following is very unsecure and MUST be removed after
  // prototype stage
  // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
  $_SESSION['login'] = true;
  $_SESSION['uid'] = $matchedUsers[0]["UserId"];
}

/**
 * Logs the user out
 *
 * WARNING: Extreemly naive!!! MUST REMOVE ASAP
 */
function logout() {
  $_SESSION['login'] = false;
  $_SESSION['uid'] = 0;
}
//}}}1
//{{{1 Friend functions
function addFriend($friendID) {
  query(
    "INSERT INTO Friends(uid, fuid) ".
    "VALUES".
      "(".getUID().", ".$friendId."),"
      "(".$friendId.", ".getUID().")"
  );
}
//}}}1
//{{{1 Story functions
function createStory() {
}
//}}}1

?>
