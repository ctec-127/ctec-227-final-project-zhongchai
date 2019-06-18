<?php

    echo '<div class="grid-container"><div class="grid-x grid-padding-x">';

    $db = db_connection();

    // parses the username from the url of the page
    $username = basename($_SERVER['REQUEST_URI'],".php");

    echo "<h2>" . $username . "'s Submissions:</h2></div><div class='grid-x grid-padding-x'>";

    // logic to determine which of the creator's works gets shown to the user
    if (isset($_SESSION['loggedin'])) {
        // if the user is an admin, OR is regular user with premium role, display everything
        if ($_SESSION['role'] == 1 || $_SESSION['premium'] == 1) {
            $sql = "SELECT * FROM work WHERE username = '$username' ORDER BY upload_date DESC";
        } else {
            $sql = "SELECT * FROM work WHERE username = '$username' AND premium = 0 ORDER BY upload_date DESC";
        }
    } else {
        $sql = "SELECT * FROM work WHERE username = '$username' AND premium = 0 ORDER BY upload_date DESC";
    }

    // echo $sql;

    $result = $db->query($sql);

    // if there is no data to show, let the user know
    if ($result->num_rows == 0){
        echo "<p class='error'>Hmm, it seems like there are no submissions to show.</p>";
    } else {
        echo "<p>" . $result->num_rows . " submissions </p>";
        // loop through submissions here
        echo "<table>";
        echo "<thead><tr><th>Work Title</th><th>Category</th><th>Uploaded</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='../work/" . $row['work_id'] . ".php'>" . $row['work_title'] . "</a></td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['upload_date'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    echo '</div></div>';

?>