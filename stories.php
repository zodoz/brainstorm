<?php

include 'dbFunctions.php';

if(!isLoggedIn()) {
    header("Location: index.php");
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
        Stories particiapted in:
        <ul>
<?php
//get stories and print them as li elements
?>
        </ul>
        <a href="entry.php?storyId=new">New Story</a>
    </body>
</html>
