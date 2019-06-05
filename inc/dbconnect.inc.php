<?php
// filename: dbconnect.php 

// this file establishes connection to the database

function db_connection(){
	$db = new mysqli('localhost','root','','a_to_z');
	if ($db->connect_error) {
		$error = $db->connect_error;
		echo $error;
	}
	$db->set_charset('utf8');
	return $db;
}

?>