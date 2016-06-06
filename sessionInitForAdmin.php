<?php
//start the session
session_start();
//set the life time of the session t0 20 minutes
$lifeTime = 1200;
setcookie(session_name(), session_id(), time() + $lifeTime, "/");
//judge whether the administrator is logged in
if(!isset($_SESSION['admin'])){
	header("Location: login.php");
}
?>