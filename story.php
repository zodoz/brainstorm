<?php

include 'dbFunctions.php';

if(!isLoggedIn()) {
    header("Location: index.php");
    exit(0);
}

if(!isset($_GET['storyId'])) {
    header("Location: stories.php");
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
        <ul>
<?php

$entries = getAllEntries($_GET['storyId']);
foreach($entries as $entry) {
    echo "<li>$entry[Entry]</li>";
}

?>
    </body>
</html>
