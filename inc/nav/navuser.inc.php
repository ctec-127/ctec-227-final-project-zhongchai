<?php
// filename: navuser.inc.php
// this is the navbar that displays when the user is logged in as a regular user

?>

<div class="top-bar">
        <div class="top-bar-left">
            <ul class="menu" data-responsive-menu="accordion">
                <li><a href="index.php">Home</a></li>
                <li><a href="works.php">Browse New</a></li>
                <li><a href="creators.php">Browse Creators</a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="menu">
                <li><a href="#">Hello <?=$_SESSION['username']?>!</a></li>
                <li><a href="#">My Collection</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a class="button" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <br>