<?php
// lists 50 newest submissions

require_once("inc/header.inc.php");
require_once("inc/dbconnect.inc.php");

echo '<div class="grid-container">
<div class="grid-x grid-padding-x"><h2>Newest Submissions</h2></div>';

$db = db_connection();

// logic to determine which of the creator's works gets shown to the user
if (isset($_SESSION['loggedin'])) {
    // if the user is an admin, OR is regular user with premium role, display everything
    if ($_SESSION['role'] == 1 || $_SESSION['premium'] == 1) {
        $sql = "SELECT * FROM work ORDER BY upload_date DESC";
    } else {
        $sql = "SELECT * FROM work WHERE premium = 0 ORDER BY upload_date DESC";
    }
} else {
    $sql = "SELECT * FROM work WHERE premium = 0 ORDER BY upload_date DESC";
}

$result = $db->query($sql);

// if there is no data to show, let the user know
if ($result->num_rows == 0){
    echo "<p class='error'>Hmm, it seems like there are no submissions to show.</p>";
} else {
    echo "<p>" . $result->num_rows . " submissions </p>";
    // loop through submissions here
    echo "<table>";
    echo "<thead><tr><th>Creator</th><th>Work Title</th><th>Category</th><th>Uploaded</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='user/" . $row['username'] . ".php'>" . $row['username'] . "</a></td>";
        echo "<td><a href='work/" . $row['work_id'] . ".php'>" . $row['work_title'] . "</a></td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['upload_date'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

echo '</div></div>';

require_once("inc/footer.inc.php");

?>