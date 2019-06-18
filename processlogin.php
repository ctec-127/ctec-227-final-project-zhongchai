<?php
// filename: processlogin.php
// This file is accessed when the user submits the login form
// It will display a confirmation message, then redirects the user back to the home page

require_once("inc/header.inc.php");
require_once("inc/dbconnect.inc.php");
require_once("inc/functions.inc.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Create a new connection to the database
    $db = db_connection();

    // grab the email/password info from the form and use it to check against the db info
    $email = test_input($_POST['email']);
    $password = hash('sha512', test_input($_POST['password']));

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    // echo $sql;

    $result = $db->query($sql);
    if ($result->num_rows == 1) {

       $_SESSION['loggedin'] = 1;
       $_SESSION['email'] = $email;

       $row = $result->fetch_assoc();
       $_SESSION['user_id'] = $row['user_id'];
       $_SESSION['username'] = $row['username'];
       $_SESSION['role'] = $row['role'];
       $_SESSION['premium'] = $row['premium'];
       $_SESSION['pay_date'] = $row['pay_date'];

       echo '<p class="success">Logging you in as ' . $row['username'] . '! Redirecting you to the home page in 3 seconds... </p>';
       header('Refresh:3; url=index.php');
       
    } else {
        echo '<p class="error">The information entered is incorrect, please try again.</p>';
        header('Refresh:2; url=login.php');
    }
    
   //  var_dump($result);

} else {
    echo '<p class="error">Go away, you don\'t belong here! </p>';
}
require_once("inc/footer.inc.php");
?>