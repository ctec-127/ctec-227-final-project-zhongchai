<?php
// filename: logout.php

require_once("inc/header.inc.php");

if(isset($_SESSION['loggedin'])){
    session_destroy();
	echo '<p class="success">You are now logged out! </p>';
	header('Refresh:3; url=index.php');
} else {
    echo '<p class="error">Go away, you don\'t belong here! </p>';
}

require_once("inc/footer.inc.php");
?>