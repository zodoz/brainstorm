<?php

if(!isset($_POST['action']))
{
  exit(0);
}

include "dbFunctions.php";

//{{{1 actions while logged out
switch($_POST['action'])
{
  case 'login':
    echo json_encode(login($_POST['username'], $_POST['password']));
    exit(0);
    break;
}
//}}}1
//{{{1 actions while logged in
if(isLoggedIn()) {
  switch($_POST['action'])
  {
    case 'logout':
      echo json_encode(logout());
      exit(0);
      break;
  }
}
//}}}1

?>
