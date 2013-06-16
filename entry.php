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
    $result = query("INSERT INTO Stories(TimeStart) SELECT NOW()");
    $storyId = getLastInsertId();
}

$entries = queryArray(
    "SELECT * ".
    "FROM Entries ".
    "WHERE StoryId = $storyId ".
    "ORDER BY Position DESC ".
    "LIMIT 1"
);
var_dump($entries);
echo "<br>";
$lastOrder = 1;
if(sizeof($entries) > 0) {
    $lastOrder = $entries[0]["Position"]+1;
}
echo $lastOrder."<br>";

// enter previous text if applicable
if(isset($_POST["text"])) {
    $entryText = $_POST["text"];
    $result = query(
        "INSERT INTO Entries(StoryId, UserId, Entry, Position) ".
        "VALUES($storyId, $userId, '$entryText', $lastOrder)"
    );
    var_dump($result);
    echo "=insert<br>";
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
