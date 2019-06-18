<?php
// filename: functions.inc.php 
// This file contains various functions used throughout the site

// fucntion to test the input data to make sure valid characters are used
// used in processregister.php, processlogin.php, processupload.php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// function to create a new profile page for the user and populates it with a user page template
// used in user/inc/processregister.php
function create_user_page($username) {
    $newuserfile = fopen("user/". $username . ".php", "w");
    $filecontent = '<?php 
    require_once("inc/header.inc.php");  
    require_once("../inc/dbconnect.inc.php"); 
    require_once("inc/fillprofile.inc.php");  
    require_once("../inc/footer.inc.php"); 
    ?>';
    fwrite($newuserfile, $filecontent);
    fclose($newuserfile);
}

// function to create a new submission page and populates it with a template
// used in work/inc/processupload.php
function create_work_page($workid) {
    $newworkfile = fopen("work/". $workid . ".php", "w");
    $filecontent = '<?php 
    require_once("inc/header.inc.php");  
    require_once("../inc/dbconnect.inc.php"); 
    $workid = ' . $workid . '; 
    require_once("inc/fillwork.inc.php");  
    require_once("../inc/footer.inc.php"); 
?>';
    fwrite($newworkfile, $filecontent);
    fclose($newworkfile);
}

?>