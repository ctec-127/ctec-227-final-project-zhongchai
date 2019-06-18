<?php
// filename: header.inc.php 

session_start();

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A to Z Galleries</title>
    <link rel="stylesheet" href="../css/foundation.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php

// if user is logged out, display the default toolbar
if(!isset($_SESSION['loggedin'])){
    require_once("navdefault.inc.php");
} else {
    // if user is logged in as a regular user, display the regular user toolbar
    if($_SESSION['role'] == 0) {
        require_once("navuser.inc.php");
    // if user is logged in as an admin, display the admin toolbar
    } elseif($_SESSION['role'] == 1) {
        require_once("navadmin.inc.php");
    } else {
        require_once("navdefault.inc.php");
    }
}

?>

