<?php

include "config.php";

session_start();

$mysqli = null;

//{{{1 Database functions
/**
 * Creates the global $mysqli variable
 */
//*
function establishConnection() {
  global $db_hostname, $db_username, $db_password,
    $db_database, $mysqli;
  $mysqli = new mysqli($db_hostname, $db_username,
    $db_password, $db_database);
  if($mysqli->connect_error) {
    die(json_encode(array(
      "success" => false,
      "error_source" => "mysqli connect",
      "error_code" => $mysqli->connect_errno,
      "error_message" => $mysqli->error_message
    )));
  }
}
//*/

/**
 * Returns the mysqli_result of a query.
 */
//*
function query($query) {
  global $mysqli;
  if($mysqli == null) {
    establishConnection();
  }
  $result = $mysqli->query($query);
  return $result;
}
//*/

/**
 * Returns an associative array result of a query.
 */
//*
function queryArray($query) {
  $result = query($query);
  $arr = array();
  // check that $result has something and then get it
  if($result) {
    while($row = $result->fetch_assoc()) {
        array_push($arr, $row);
    }
  }
  return $arr;
}
//*/

/**
 * Returns true if the query returns at least one row.
 */
function queryEmpty($query) {
  $result = query($query);
  return $result->num_rows == 0;
}

function getLastInsertId() {
    global $mysqli;
    return $mysqli->insert_id;
}
//}}}1
//{{{1 Current user function
function getUserId() {
  return $_SESSION['uid'];
}
//}}}1
//{{{1 Login functions
/**
 * Returns ture if the user is logged in, false otherwise
 *
 * WARNING: Extreemly naive!!! MUST REMOVE ASAP
 */
//*
function isLoggedIn() {
  if(!isset($_SESSION['login'])) {
    return false;
  }
  return $_SESSION['login'];
}
//*/

/**
 * Logs the user in if able
 */
//*
function login($username, $password) {
  global $password_salt;
  $qCanLogIn =
    "SELECT UserId ".
    "FROM Users ".
    "WHERE ".
      "Username = '$username' ".
      "AND Password = SHA1('$password$password_salt')";
  $matchedUsers = queryArray($qCanLogIn);
  if(sizeof($matchedUsers) <= 0) {
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

  return array(
      "success" => true
  );
  //*/
}
//*/

/**
 * Logs the user out
 *
 * WARNING: Extreemly naive!!! MUST REMOVE ASAP
 */
//*
function logout() {
  $_SESSION['login'] = false;
  $_SESSION['uid'] = 0;
}
//*/
//}}}1
//{{{1 Friend functions
//*
function addFriend($friendID) {
}
//*/
//}}}1
//{{{1 Story functions
function getUserStories() {
    return queryArray(
        "SELECT StoryId, IFNULL(Title, 'Untitled') AS Title, ".
            "NumRounds, TimeStart, TimeEnd ".
        "FROM ".
            "Stories JOIN User_Stories USING(StoryId) ".
        "WHERE UserId = ".getUserId()
    );
}
function createStory() {
    global $mysqli;
    query(
        "INSERT INTO Story(TimeStart) VALUES(NOW())"
    );
    return getLastInsertId();
}
/**
 * Links an array of users to a story.
 */
function addusersToStory($storyId, $userIds, $creatorUserId = 0) {
    $q = "INSERT INTO User_Stories(UserId, StoryId, Creator) VALUES";
    $comma = "";
    foreach($userIds as $userId) {
        $creator = 0;
        if($creatorUserId = $userId) {
            $creator = 1;
        }
        $q .= "($userId, $storyId, $creator)".$comma;
        $comma = ",";
    }
    query($q);
}
//}}}1
//{{{1 Entry functions
function getLastEntry($storyId) {
    return queryArray(
        "SELECT * ".
        "FROM Entries ".
        "WHERE StoryId = $storyId ".
        "ORDER BY Position DESC ".
        "LIMIT 1"
    );
}
function insertEntry($storyId, $userId, $entryText, $position) {
    query(
        "INSERT INTO Entries(StoryId, UserId, Entry, Position) ".
        "VALUES($storyId, $userId, '$entryText', $position)"
    );
}
function getAllEntries($storyId) {
    return queryArray(
        "SELECT * ".
        "FROM Entries ".
        "WHERE StoryId = $storyId ".
        "ORDER BY Position ASC"
    );
}
//}}}1

?>
