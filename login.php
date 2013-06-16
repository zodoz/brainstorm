<?php

include "dbFunctions.php";

$sn = $_POST['uname'];
$pw = $_POST['pword'];

function redirectToStory() {
    header("Location: stories.php");
}

if(isLoggedIn()) {
    redirectToStory();
}

if($sn == '') {
    die("Please enter in a Username");
}
if($pw == '') {
    die("Please enter in a Password");
}

$loginStatus = login($sn, $pw);
if($loginStatus["success"] == true) {
    redirectToStory();
} else {
    die("Incorrect Username or Password!");
}

?>
