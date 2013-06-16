<?php

include 'dbFunctions.php';

if(isLoggedIn()) {
    header("Location: stories.php");
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
        <form method="POST" action="login.php">
            <label for="sn">Username</label>
            <input type="text" name="uname" id="sn">
            <br>
            <label for="pw">Password</label>
            <input type="text" name="pword" id="pw">
            <br>
            <button type="submit">Sign in</button>
        </form>
    </body>
</html>
