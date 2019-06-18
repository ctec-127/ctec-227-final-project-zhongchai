<?php
// lists all the creators

require_once("inc/header.inc.php");
require_once("inc/dbconnect.inc.php");

echo '<div class="grid-container">
<div class="grid-x grid-padding-x"><h2>List of Creators</h2></div>';

$db = db_connection();

$sql = "SELECT * FROM user WHERE role = 1 ORDER BY rand() LIMIT 20";

$result = $db->query($sql);

if ($result->num_rows == 0){
    echo "<div class='grid-x grid-padding-x'><p class='error'>Hmm, it seems like there are no creators to show.</p>";
} else {
    echo "<div class='grid-x grid-padding-x'><p>Displaying " . $result->num_rows . " random users </p>";
    // loop through submissions here
    echo "<table>";
    echo "<thead><tr><th>User</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='user/" . $row['username'] . ".php'>" . $row['username'] . "</a></td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

echo '</div></div>';

require_once("inc/footer.inc.php");

?>