<?php

    echo '<div class="grid-container"><div class="grid-x grid-padding-x">';

    $db = db_connection();

    $sql = "SELECT * FROM work WHERE work_id = '$workid'";
    $result = $db->query($sql);

    // if there is no data to show, let the user know
    if ($result->num_rows == 0){
        echo "<div class='error'>There was an error displaying the requested submission.</div>";
    } else {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $title = $row['work_title'];
        $filepath = $row['filepath'];
        $category = $row['category'];
        $premium = $row['premium'];
        $date = $row['upload_date'];

        $permission = true;
        $errormsg = '';

        // if the uploaded file is premium, deny or allow access based on user type
        if ($premium == 1) {
            if (isset($_SESSION['loggedin'])) {
                // if the user is an admin, OR is regular user with premium role, display everything
                if ($_SESSION['role'] == 1 || $_SESSION['premium'] == 1) {
                    $permission = true;
                } else {
                    $permission = false;
                    $errormsg = "Sorry! You do not have permission to view this premium file. ";
                }
            } else {
                $permission = false;
                $errormsg = "Sorry! You must be logged in first.";
            }
        }

        if ($permission = true) {
?>

<div class="img-container">
    <img src="upload/<?= $filepath?>" alt="Submission image">
</div>
</div>
<div class="grid-x grid-padding-x">
<div class="large-12 cell"><h3><?= $title?></h3></div>
</div>
<div class="grid-x grid-padding-x">
<div class="medium-6 cell">Creator: <?= $username?></div>
<div class="medium-6 cell">Upload date: <?= $date?></div>
</div>
<div class="grid-x grid-padding-x">
<div class="medium-6 cell">Category: <?= $category?></div>
<div class="medium-6 cell"><a href="#">Favorite Work</a></div>

<?php 
        } else {
            echo '<div class="error">' . $errormsg . '</div>';
        }

    }

    echo '</div></div>';

?>