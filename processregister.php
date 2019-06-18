<?php
// filename: processregister.php
// This file is accessed when the user submits the register form on the login page
// It creates a new entry in the db, as well as a customized profile page and url for the user

require_once("inc/header.inc.php");
require_once("inc/dbconnect.inc.php");
require_once("inc/functions.inc.php");

$success = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // connect to the db
    $db = db_connection();

    // Check required fields to see if they were filled in
    $required = array('email', 'username', 'password');

    // Loop over field names, make sure each one exists and is not empty
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
            echo 'something went wrong in required loop';
        }
    }

    // Check if a radio button was selected
    if(isset($_POST['role'])){
        // an array containing the radio input values that are allowed
        $allowedAnswers = array('admin', 'user');
    
        // the radio button value that the user sent us
        $chosenAnswer = $_POST['role'];
    
        // check that the value is in our array of allowed values
        if(in_array($chosenAnswer, $allowedAnswers)){
            // check to see if the user submitted string matches the admin or user value
            if(strcasecmp($chosenAnswer, 'admin') == 0){
                // set the role for the user to admin
                $setrole = 1;
            } elseif(strcasecmp($chosenAnswer, 'user') == 0) {
                // set the role for the user to regular user
                $setrole = 0;
            } else {
                $error = true;
                echo 'something went wrong in inner role loop';
            }
        } else {
            $error = true;
            echo 'something went wrong in outer role loop';
        }
    }

    if ($error) {
        echo '<div class="error">All fields are required.</div>';
    } else {
        $email = test_input($_POST['email']);
        $username = test_input($_POST['username']);
        $password = hash('sha512', test_input($_POST['password']));
        $role = $setrole;
        $sql = "INSERT INTO user (email,username,password,role,premium) VALUES ('$email','$username','$password','$role',0)";
            // echo $sql;
        $result = $db->query($sql);

        if($db->error){
            echo '<div class="error">' . $db->error . '</div>';
        } else {
            create_user_page($username);
            echo '<div class="success">Your registration has been successfully processed! 
            <br>You may now log in using your email ' . $email . '</div>';
            $success = true;
        }
    }
} else {
    echo '<p class="error">Go away, you don\'t belong here! </p>';
}
require_once("inc/footer.inc.php");
?>