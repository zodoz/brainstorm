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
$stories = getUserStories();
$index = 1;
foreach($stories as $story) {
    $title = $story['Title'];
    if($title == "Untitled") {
        $title .= $index++;
    }
    echo "<li>$title - <a href='entry.php?storyId=$story[StoryId]'>Add Entry</a>, <a href='story.php?storyId=$story[StoryId]'>View Story</a></li>";
}
?>
        </ul>
        <a href="entry.php?storyId=new">New Story</a>
    </body>
</html>
