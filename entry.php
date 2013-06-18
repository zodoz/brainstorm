<?php

include "dbFunctions.php";

if(!isLoggedIn()) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>

<?php

$storyId = $_GET['storyId'];
$userId = getUserId();
$entryText = "";

if($storyId == "new") {
    // create new story and continue as if storyid had been set all along
    $storyId = createStory();
    addUsersToStory($storyId, [$userId], $userId);
}

$entries = getLastEntry($storyId);
var_dump($entries);
echo "<br>";
$lastPosition = 1;
if(sizeof($entries) > 0) {
    $lastPosition = $entries[0]["Position"]+1;
}
echo $lastPosition."<br>";

// enter previous text if applicable
if(isset($_POST["text"])) {
    $entryText = $_POST["text"];
    insertEntry($storyId, $userId, $entryText, $lastPosition);
} else {
    $entryText = $entries[0]["Entry"];
}
//*/

echo "Last entry: $entryText";

?>
    <form method="POST" action="entry.php?storyId=<?php echo $storyId; ?>">
        <textarea name="text" id="entryText"></textarea>
        <br>
        <button type="submit">Add to story</button>
    </form>

    </body>
</html>
