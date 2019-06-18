<?php 
// filename: dbquery.php 
// this file grabs the current user info and stores them in variables

// linked in the header to check for user info on every page
// this is a wip

// connect to the database
$db = db_connection();

// check for session id
// if login is true, get the login user id and store them
// if no login, display logged out link

$sql = "SELECT * FROM user";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()) {

    // declare arrays to store database content
    $user_id = $row['user_id'];
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $member_type = $row['member_type'];
    $premium = $row['premium'];
    $pay_date = $row['pay_date'];
}

?>