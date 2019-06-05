<?php
// filename: dbsession.php

// This file handles the session information

function log_page($db,$page_name){
	if(!isset($_SESSION['id'])){
		$user_id = "0";
	} else {
		$user_id = $_SESSION['id'];
	}
	$sql = "INSERT INTO logs (user_id,page_name) VALUES ('$user_id','$page_name')";
	$result = $db->query($sql);
}

?>